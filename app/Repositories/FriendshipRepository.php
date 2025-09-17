<?php

namespace App\Repositories;

use App\Enums\FriendshipStatus;
use App\Models\Friendship;
use App\Repositories\Contracts\FrienshipRepositoryInterface;

class FriendshipRepository implements FrienshipRepositoryInterface
{
    public function create(int $toUserId, int $fromUserId)
    {
        if ($fromUserId == $toUserId) {
            return false;
        }

        $exists = Friendship::whereIn('user_id', [$fromUserId, $toUserId])
            ->whereIn('friend_id', [$fromUserId, $toUserId])
            ->exists();

        if ($exists) {
            return false;
        }

        Friendship::create([
            'user_id' => $fromUserId,
            'friend_id' => $toUserId,
            'status' => FriendshipStatus::PENDING
        ]);

        return true;
    }
}
