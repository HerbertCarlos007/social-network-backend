<?php

namespace App\Services;

use App\Http\Requests\StoreUpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostService
{
    private PostRepositoryInterface $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function store(StoreUpdatePostRequest $request): PostResource
    {
        $dto = $request->toDTO();
        $post = $this->postRepository->create($dto);
        return new PostResource($post);
    }

    public function index()
    {
        $posts = $this->postRepository->index();
        return PostResource::collection($posts);
    }

    public function show(Post $post): PostResource
    {
        $post = $this->postRepository->show($post);
        return new PostResource($post);
    }

    public function update(StoreUpdatePostRequest $request, Post $post): PostResource
    {
        $dto = $request->toDTO();
        $post = $this->postRepository->update($dto, $post);
        return new PostResource($post);
    }

    public function destroy(Post $post): bool
    {
        return $this->postRepository->destroy($post);
    }
}
