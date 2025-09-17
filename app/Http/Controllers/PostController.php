<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUpdatePostRequest;
use App\Models\Post;
use App\Services\PostService;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function store(StoreUpdatePostRequest $request)
    {
        return $this->postService->store($request);
    }

    public function index()
    {
        return $this->postService->index();
    }

    public function userPosts()
    {
        return $this->postService->userPosts();
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
