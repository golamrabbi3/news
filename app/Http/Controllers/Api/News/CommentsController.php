<?php

namespace App\Http\Controllers\Api\News;

use App\Enums\PaginatedNumber;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\News\CommentRequest;
use App\Http\Resources\Comments\CommentResource;
use App\Models\News;
use Exception;
use Illuminate\Http\JsonResponse;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(News $news): JsonResponse
    {
        $data = CommentResource::collection(
            $news->comments()->whereIsApproved(true)
                ->latest()
                ->paginate(PaginatedNumber::Comments)
        );

        return response()->json([
            'message' => __('Fetched comment list successfully.'),
            'data' => $data->response()->getData(true),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, News $news): JsonResponse
    {
        $comment = $news->comments()->create([
            'comment_id' => $request->input('comment_id', null),
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);

        if ($comment) {
            return response()->json([
                'message' => __('The comment has been placed successfully.'),
                'data' => new CommentResource($comment),
            ]);
        }

        return response()->json([
            'message' => __('Failed to place the comment! Please try again.'),
        ], 400);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, News $news, int $id): JsonResponse
    {
        $comment = $news->comments()->whereId($id)->whereUserId(request()->user()->id)->first();

        if ($comment && $comment->update($request->only('description'))) {
            return response()->json([
                'message' => __('The comment has been updated successfully.'),
                'data' => new CommentResource($comment),
            ]);
        }

        return response()->json([
            'message' => __('Failed to update the comment! Please try again.')
        ], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news, int $id): JsonResponse
    {
        try {
            $comment = $news->comments()->whereId($id)->whereUserId(request()->user()->id)->first();

            if ($comment && $comment->delete()) {
                $comment->comments()->delete();

                return response()->json(['message' => __('The comment has been deleted successfully.')]);
            }
        } catch (Exception $e) {
            report($e);
        }

        return response()->json([
            'message' => __('Failed to delete the comment! Please try again.'),
        ], 400);
    }
}
