<?php

namespace App\DTO;

class PostDTO
{
    public function __construct(
        public string $content,
        public string $image_post_url,
        public string $user_id
    ) {}

    public function toArray(): array
    {
        return [
            'content' => $this->content,
            'image_post_url' => $this->image_post_url,
            'user_id' => $this->user_id
        ];
    }
}
