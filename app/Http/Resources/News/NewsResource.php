<?php

namespace App\Http\Resources\News;

use App\Helpers\PaginatedNumber;
use App\Http\Resources\Comments\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $request->news ? $this->description : $this->excerpt(),
            'status' => $this->status,
            'author_id' => $this->user?->id,
            'author_name' => $this->user?->full_name,
            'author_email' => $this->user?->email,
            'author_avatar' => $this->user?->avatar?->path,
            'featured_image' => $this->featuredImage?->path,
            'categories' => $this->categories?->pluck('name', 'id'),
            'tags' => $this->tags?->pluck('name', 'id'),
            'comments_count' => $this->comments_count ?? 0,
            'comments' => $this->when(
                $request->news,
                CommentResource::collection(
                    $this->comments()->whereIsApproved(true)
                        ->latest()
                        ->paginate(
                            perPage: PaginatedNumber::GuestComments,
                            pageName: 'comments',
                        )
                )->response()->getData(true)
            ),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->diffForHumans(),
        ];
    }
}
