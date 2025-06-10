<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(StoreUpdateUserRequest $request)
    {

        $avatarPath = null;

        if ($request->hasFile('avatar_url')) {
            $avatarPath = request()->file('avatar_url')->store('avatars', 's3');
            Storage::disk('s3')->setVisibility($avatarPath, 'public');

            $avatarUrl = Storage::disk('s3')->url($avatarPath);
        }

        $userDto = $request->toDTO();
        $userDto->avatar_url = $avatarUrl;
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
