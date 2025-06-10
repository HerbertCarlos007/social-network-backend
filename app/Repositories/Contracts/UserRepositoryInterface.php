<?php

namespace App\Repositories\Contracts;

use App\DTO\UserDTO;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function create(UserDTO $userDTO): User;
    public function index(): Collection;
    public function findByEmail(string $email): User;
}
