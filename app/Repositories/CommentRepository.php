<?php

namespace App\Repositories;

use App\DTO\CommentDTO;
use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository implements CommentRepositoryInterface
{
    public function create(CommentDTO $dto): Comment
    {
        return Comment::create($dto->toArray());
    }

    public function index(): Collection
    {
        return Comment::all();
    }

    public function show(Comment $comment): Comment
    {
        return $comment;
    }

    public function update(Comment $comment, CommentDTO $dto): Comment
    {
        $comment->update($dto->toArray());
        return $comment;
    }

    public function destroy(Comment $comment): bool
    {
        return $comment->delete();
    }
}
