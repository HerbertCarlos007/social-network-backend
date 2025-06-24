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
        $userId = auth()->id();

        $posts = Post::with('user', 'likes', 'comments')
            ->orderByDesc('id')
            ->get()
            ->map(function ($post) use ($userId) {
                $post->liked_by_user = $post->likes->contains('user_id', $userId);
                $post->count_likes = $post->likes->count();
                return $post;
            });

        return $posts;
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
