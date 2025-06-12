<?php

namespace App\Services;

use App\Http\Requests\LikeStoreRequest;
use App\Http\Resources\LikeResource;
use App\Repositories\Contracts\LikeRepositoryInterface;

class LikeService
{
    private LikeRepositoryInterface $likeRepository;

    public function __construct(LikeRepositoryInterface $likeRepository)
    {
        $this->likeRepository = $likeRepository;
    }

    public function store(LikeStoreRequest $request)
    {
        $likeDto = $request->toDTO();
        if ($this->likeRepository->likeExists($likeDto->userId, $likeDto->postId)) {
            $this->likeRepository->delete($likeDto->userId,  $likeDto->postId);

            return response()->json([
                'message' => 'Like removido',
                'liked' => false
            ]);
        }

        $like = $this->likeRepository->create($likeDto);

        return response()->json([
            'message' => 'Like criado',
            'liked' => true,
            'data' => new LikeResource($like)
        ], 201);
    }
}
