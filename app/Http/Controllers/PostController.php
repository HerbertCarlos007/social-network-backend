<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Services\PostService;

class PostController extends Controller
{
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(StoreUpdatePostRequest $request)
    {
        $post = $this->postService->store($request);
        return response()->json([
            'post' => $post
        ],201);
    }

    public function index()
    {
        return $this->postService->index();
    }

    public function show(Post $post) {
        return $this->postService->show($post);
    }

    public function update(StoreUpdatePostRequest $request, Post $post)
    {
        return $this->postService->update($request, $post);
    }

    public function destroy(Post $post)
    {
        $this->postService->destroy($post);
        return response()->noContent();
    }
}
