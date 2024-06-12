<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image?->path,
            'is_active' => $this->is_active,
            'parent_category' => $this->category?->only('id', 'name'),
            'categories' => $this->whenLoaded('categories', $this->categories()->pluck('name', 'id')),
            'categories_count' => $this->categories_count ?? 0,
            'news_count' => $this->news_count ?? 0,
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->diffForHumans(),
        ];
    }
}
