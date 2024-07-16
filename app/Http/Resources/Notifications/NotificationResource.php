<?php

namespace App\Http\Resources\Notifications;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = (object) $this->data;

        return [
            'id' => $this->id,
            'icon' => $data->icon ?? null,
            'title' => $data->title ?? null,
            'message' => $data->message ?? null,
            'action_url' => $data->action_url ?? null,
            'read_at' => $this->read_at?->toDayDateTimeString(),
            'created_at' => $this->created_at->toDayDateTimeString(),
        ];
    }
}
