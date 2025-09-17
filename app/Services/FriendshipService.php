<?php

namespace App\Services;

use App\Repositories\FriendshipRepository;

class FriendshipService
{
    private FriendshipRepository $friendshipRepository;

    public function __construct(FriendshipRepository $friendshipRepository)
    {
        $this->friendshipRepository = $friendshipRepository;
    }

    public function sendFriendRequest($toUserId)
    {
        $fromUserId = auth()->id();
    }
}
