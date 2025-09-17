<?php

namespace App\Repositories\Contracts;

interface FrienshipRepositoryInterface
{
    public function create(int $toUserId, int $fromUserId);
}
