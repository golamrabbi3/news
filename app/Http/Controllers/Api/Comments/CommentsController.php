<?php

namespace App\Http\Controllers\Api\Comments;

use App\Enums\PaginatedNumber;
use App\Http\Controllers\Controller;
use App\Http\Resources\Comments\CommentResource;
use App\Models\Comment;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = CommentResource::collection(
                Comment::with('user.avatar')
                    ->withCount('comments')
                    ->latest()
                    ->paginate(PaginatedNumber::Comments)
            );

            return response()->json([
                'message' => __('Fetched comment list successfully.'),
                'data' => $data->response()->getData(true),
            ]);
        } catch (Exception $e) {
            report($e);
        }

        return response()->json([
            'message' => __('Failed to fetch comment list.'),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): JsonResponse
    {
        $comment->load(
            'user.avatar',
        )->loadCount('comments');

        return response()->json([
            'message' => __('Fetched comment successfully.'),
            'data' => new CommentResource($comment),
        ]);
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, Comment $comment): JsonResponse
    {
        $request->validate(['is_approved' => 'required|boolean']);

        if ($comment->update($request->only('is_approved'))) {
            return response()->json([
                'message' => __('The comment has been :update successfully.', [
                    'update' => $request->is_approved ? __('approved') : __('disapproved'),
                ]),
                'data' => new CommentResource($comment),
            ]);
        }

        return response()->json([
            'message' => __('Failed to approve the comment! Please try again.')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        try {
            if ($comment->delete()) {
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
