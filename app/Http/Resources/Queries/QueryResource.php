<?php

namespace App\Http\Resources\Queries;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QueryResource extends JsonResource
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
            'name' => $this->full_name,
            'email' => $this->email,
            'mobile_contact' => $this->mobile_contact,
            'address' => $this->address,
            'subject' => $this->subject,
            'message' => $this->subject,
        ];
    }
}
