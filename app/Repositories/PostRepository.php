<?php

namespace App\Repositories;

use App\DTO\PostDTO;
use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    public function create(PostDTO $dto): Post
    {
        return Post::create($dto->toArray());
    }

    public function index(): Collection
    {
        return Post::with('user')->orderByDesc('id')->get();
    }

    public function show(Post $post): Post
    {
        return $post;
    }

    public function update(PostDTO $dto, Post $post ): Post
    {
        $post->update($dto->toArray());
        return $post;
    }

    public function destroy(Post $post): bool
    {
        return $post->delete();
    }

}
