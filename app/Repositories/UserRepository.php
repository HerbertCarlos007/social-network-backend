<?php

namespace App\Repositories;

use App\DTO\UserDTO;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{

    public function create(UserDTO $userDTO): User
    {
        return User::create($userDTO->toArray());
    }

    public function index(): Collection
    {
        return User::all();
    }

    public function findByEmail(string $email): User
    {
        return User::where('email', $email)->first();
    }
}
