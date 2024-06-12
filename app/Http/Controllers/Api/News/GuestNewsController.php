<?php

namespace App\Http\Controllers\Api\News;

use App\Http\Controllers\Controller;
use App\Http\Resources\News\NewsCollection;
use App\Http\Resources\News\NewsResource;
use App\Models\News;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use NewsStatus;
use PaginatedNumber;

class GuestNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $data = new NewsCollection(
            News::whereStatus(NewsStatus::Published)->with(
                'user',
                'categories',
                'tags',
                'featuredImage'
            )
                ->withCount([
                    'comments' => (fn (Builder $query) => $query->whereIsApproved(true)),
                ])
                ->latest()
                ->paginate(PaginatedNumber::GuestNews)
        );

        return response()->json([
            'message' => __('Fetched news list successfully.'),
            'data' => $data->response()->getData(true),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        $news = News::where([
            'id' => $id,
            'status' => NewsStatus::Published,
        ])
            ->with(
                'user',
                'categories',
                'tags',
                'featuredImage',
            )
            ->withCount([
                'comments' => (fn (Builder $query) => $query->whereIsApproved(true)),
            ])
            ->firstOrFail();

        return response()->json([
            'message' => __('Fetched news successfully.'),
            'data' => new NewsResource($news),
        ]);
    }
}
