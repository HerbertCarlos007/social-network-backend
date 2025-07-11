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
            'avatar_url' => $this->user->avatar_url,
            'user_id' => $this->user_id,
            'liked_by_user' => $this->liked_by_user,
            'count_likes' => $this->count_likes,
            'name' => $this->user->name,
            'comments' => CommentResource::collection($this->comments),
            'created_at' => $this->created_at->diffForHumans(),
        ];
    }
}
