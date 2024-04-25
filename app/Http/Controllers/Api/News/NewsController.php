<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\News\NewsRequest;
use App\Http\Resources\News\NewsCollection;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                ->withCount('comments')
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
        $parameters = $request->only('title', 'description', 'status');
        $parameters['user_id'] = $request->user()->id();

        DB::beginTransaction();

        try {
            $news = News::create($parameters);
            $news->categories()->sync($request->input('categories', []));
            $news->tags()->sync($request->input('tags', []));
            //TODO::upload featured image here using $request->featured_image
            $news->featuredImage()->create([
                'path' => fake()->imageUrl(),
                'is_featured' => true,
            ]);

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
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request, News $news)
    {
        $message = __('Failed to update the news! Please try again.');
        DB::beginTransaction();
        try {
            if ($news->update($request->only('title', 'description', 'status'))) {
                throw new Exception($message);
            }
            $news->categories()->sync($request->input('categories', []));
            $news->tags()->sync($request->input('tags', []));
            //TODO::upload featured image here using $request->featured_image
            $news->featuredImage()->createOrUpdate([
                'path' => fake()->imageUrl(),
                'is_featured' => true,
            ]);

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
        if ($news->delete()) {
            return response()->json(['message' => __('The news has been deleted.')]);
        }

        return response()->json([
            'message' => __('Failed to delete the news! Please try again.')
        ], 400);
    }
}
