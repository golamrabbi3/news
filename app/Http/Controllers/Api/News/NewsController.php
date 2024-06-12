<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\News\NewsRequest;
use App\Http\Resources\News\NewsCollection;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use App\Services\FileService;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use MediaPath;
use PaginatedNumber;
use Throwable;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = new NewsCollection(
            News::with(
                'user',
                'categories',
                'tags',
                'featuredImage'
            )
                ->withCount([
                    'comments' => (fn (Builder $query) => $query->whereIsApproved(true)),
                ])
                ->latest()
                ->paginate(PaginatedNumber::News)
        );

        return response()->json([
            'message' => __('Fetched news list successfully.'),
            'data' => $data->response()->getData(true),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $parameters = $request->only('title', 'description', 'status');
            $parameters['user_id'] = $request->user()->id;
            $news = News::create($parameters);
            $news->categories()->sync($request->input('categories', []));
            $news->tags()->sync($request->input('tags', []));

            if ($request->hasFile('featured_image')) {
                $this->_uploadFeaturedImage($request->file('featured_image'), $news);
            }
            DB::commit();

            return response()->json([
                'message' => __('The news has been created successfully.'),
                'data' => new NewsResource($news),
            ]);
        } catch (Throwable $e) {
            DB::rollBack();
            report($e);
        }

        return response()->json([
            'message' => __('Failed to create the news! Please try again.')
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news): JsonResponse
    {
        $news->load(
            'user',
            'categories',
            'tags',
            'featuredImage',
            'comments.user',
        )->loadCount([
            'comments' => (fn(Builder $query) => $query->whereIsApproved(true)),
        ]);

        return response()->json([
            'message' => __('Fetched news successfully.'),
            'data' => new NewsResource($news),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, News $news): JsonResponse
    {
        $message = __('Failed to update the news! Please try again.');
        DB::beginTransaction();
        try {
            if (!$news->update($request->only('title', 'description', 'status'))) {
                throw new Exception($message);
            }
            $news->categories()->sync($request->input('categories', []));
            $news->tags()->sync($request->input('tags', []));

            if ($request->hasFile('featured_image')) {
                $this->_uploadFeaturedImage($request->file('featured_image'), $news);
            }

            DB::commit();

            return response()->json([
                'message' => __('The news has been updated successfully.'),
                'data' => new NewsResource($news),
            ]);
        } catch (Throwable $e) {
            DB::rollBack();
            report($e);
        }

        return response()->json(['message' => $message], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news): JsonResponse
    {
        try {
            $news->categories()->delete();
            $news->tags()->delete();
            $news->featuredImage()->delete();

            if ($news->delete()) {
                return response()->json(['message' => __('The news has been deleted successfully.')]);
            }
        } catch(Throwable $e) {
            report($e);
        }

        return response()->json([
            'message' => __('Failed to delete the news! Please try again.')
        ], 400);
    }

    private function _uploadFeaturedImage(UploadedFile $file, News $news): bool
    {
        $path = FileService::upload(
            file: $file,
            path: MediaPath::News,
            fileName: 'news',
            suffix: $news->id,
            disk: 'public',
            imageWidth: 1024,
                imageHeight: 400
        );

        if ($path) {
            $news->featuredImage()->updateOrCreate([
                'path' => $path,
                'is_featured' => true,
            ]);

            return true;
        }

        return false;
    }
}
