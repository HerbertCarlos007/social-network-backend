<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeStoreRequest;
use App\Services\LikeService;

class LikeController extends Controller
{
    private LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function store(LikeStoreRequest $request)
    {
        return $this->likeService->store($request);
    }
}
