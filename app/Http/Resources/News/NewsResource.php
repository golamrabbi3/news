<?php

namespace App\Http\Resources\News;

use App\Http\Resources\Comments\CommentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use PaginatedNumber;

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
            'description' => $this->description,
            'status' => $this->status,
            'author_id' => $this->user?->id,
            'author_name' => $this->user?->name,
            'author_email' => $this->user?->email,
            'author_image' => $this->user?->profileImage?->path,
            'comments_count' => $this->comments_count,
            'featured_image' => $this->featuredImage?->path,
            'categories' => $this->categories->pluck('name', 'slug'),
            'tags' => $this->tags->pluck('name', 'id'),
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
