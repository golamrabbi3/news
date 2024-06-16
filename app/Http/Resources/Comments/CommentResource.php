<?php

namespace App\Http\Resources\Comments;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'description' => $request->comment ? $this->description : $this->excerpt(),
            'is_approved' => $this->is_approved,
            'commentator_id' => $this->user?->id,
            'commentator_name' => $this->user?->full_name,
            'commentator_email' => $this->user?->email,
            'commentator_avatar' => $this->user?->avatar?->path,
            'commentable_type' => $this->commentable_type,
            'commentable_id' => $this->commentable_id,
            'comments_count' => $this->comments_count,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->diffForHumans(),
        ];
    }
}
