<?php

namespace App\Http\Resources\Queries;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class QueryCollection extends ResourceCollection
{
    public static $wrap = 'queries';
    
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
