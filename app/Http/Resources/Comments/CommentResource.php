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
            'description' => $this->description,
            'is_approved' => $this->is_approved,
            'commentator_id' => $this->user?->id,
            'commentator_name' => $this->user?->name,
            'commentator_email' => $this->user?->email,
            'commentator_image' => $this->user?->profileImage?->path,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->diffForHumans(),
        ];
    }
}
