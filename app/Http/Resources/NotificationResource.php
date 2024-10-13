<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        // Customize the response structure
        return [
            'title' => $this->data['title'],
            'body'  => $this->data['body'],
            'data'  => $this->data['data'],
            'is_read' => $this->read(),
            'date' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
