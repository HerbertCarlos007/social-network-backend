<?php

namespace App\DTO;

class LikeDTO
{
    public function __construct(
        public string $userId,
        public string $postId ){}

    public function toArray(): array
    {
        return [
            'user_id' => $this->userId,
            'post_id' => $this->postId,
        ];
    }
}
