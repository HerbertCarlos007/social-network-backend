<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(StoreUpdateUserRequest $request)
    {
        $userDto = $request->toDTO();
        $userDto->password = Hash::make($userDto->password);
        $user =  $this->userRepository->create($userDto);
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'user' =>  new UserResource($user),
            'access_token' => $token,
            'token_type' => 'Bearer'
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = $this->userRepository->findByEmail($data['email']);
        return response()->json([
            'access_token' => $user->createToken('api_token')->plainTextToken,
            'token_type' => 'Bearer',
            'user' => new UserResource($user),
        ]);
    }

    public function index() {
        $posts = $this->userRepository->index();
        return UserResource::collection($posts);
    }
}
