<?php

namespace App\Repositories\Contracts;

use App\DTO\PostDTO;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;


interface PostRepositoryInterface
{
    public function create(PostDTO $dto): Post;
    public function index(): Collection;
    public function userPosts(): Collection;
    public function show(Post $post): Post;
    public function update(PostDTO $dto, Post $post ): Post;
    public function destroy(Post $post): bool;
}
