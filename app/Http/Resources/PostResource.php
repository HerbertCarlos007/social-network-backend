<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'content' => $this->content,
            'image_post_url' => $this->image_post_url,
            'user_id' => $this->user_id,
            'name' => $this->user->name,
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
