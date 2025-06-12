<?php

namespace App\Repositories;

use App\DTO\LikeDTO;
use App\Models\Like;
use App\Repositories\Contracts\LikeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LikeRepository implements LikeRepositoryInterface
{
    public function likeExists(string $userId, string $postId): bool
    {
        return Like::where('user_id',  $userId )
            ->where('post_id',  $postId)
            ->exists();
    }

    public function create(LikeDTO $likeDto): Like
    {
        return Like::create($likeDto->toArray());
    }

    public function delete(string $userId, string $postId): bool
    {
        return Like::where('user_id', $userId)
            ->where('post_id', $postId)
            ->delete();
    }
}
