<?php

namespace App\DTO;

class CommentDTO
{
    public function __construct(
        public string $postId,
        public string $userId,
        public string $content

    )
    {
    }

    public function toArray(): array
    {
        return [
            'post_id' => $this->postId,
            'user_id' => $this->userId,
            'content' => $this->content,
        ];
    }
}
