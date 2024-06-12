<?php

namespace App\Http\Controllers\Api\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tags\TagRequest;
use App\Http\Resources\Tags\TagCollection;
use App\Http\Resources\Tags\TagResource;
use App\Models\Tag;
use Exception;
use PaginatedNumber;
use Throwable;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = new TagCollection(
                Tag::withCount('news')
                    ->latest()
                    ->paginate(PaginatedNumber::Tags)
            );

            return response()->json([
                'message' => __('Fetched tag list successfully.'),
                'data' => $data->response()->getData(true),
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'message' => __('Failed to fetch tag list.'),
            ]);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        try {
            $tag = Tag::create($request->only('name'));

            return response()->json([
                'message' => __('The tag has been created successfully.'),
                'data' => new TagResource($tag),
            ]);
        } catch (Throwable $e) {
            report($e);
        }

        return response()->json([
            'message' => __('Failed to create the tag! Please try again.')
        ], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        $tag->loadCount('news');

        return response()->json([
            'message' => __('Fetched tag successfully.'),
            'data' => new TagResource($tag),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, Tag $tag)
    {
        $message = __('Failed to update the tag! Please try again.');
        try {
            if (!$tag->update($request->only('name'))) {
                throw new Exception($message);
            }

            return response()->json([
                'message' => __('The tag has been updated successfully.'),
                'data' => new TagResource($tag),
            ]);
        } catch (Throwable $e) {
            report($e);
        }

        return response()->json(['message' => $message], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        try {
            if ($tag->delete()) {
                return response()->json(['message' => __('The tag has been deleted successfully.')]);
            }
        } catch (Throwable $e) {
            report($e);
        }

        return response()->json([
            'message' => __('Failed to delete the tag! Please try again.')
        ], 400);
    }
}
