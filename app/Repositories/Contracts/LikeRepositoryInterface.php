<?php

namespace App\Repositories\Contracts;

use App\DTO\LikeDTO;
use App\Models\Like;
use Illuminate\Database\Eloquent\Collection;

interface LikeRepositoryInterface
{
    public function likeExists(string $userId, string $postId): bool;
    public function create(LikeDTO $likeDto): Like;
    public function delete(string $userId, string $postId): bool;
}
