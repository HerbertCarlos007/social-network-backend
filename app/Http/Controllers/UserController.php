<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return $this->userService->index();
    }

    public function login(LoginRequest $request)
    {
        return $this->userService->login($request);
    }

    public function store(StoreUpdateUserRequest $request)
    {
        return $this->userService->store($request);
    }
}
