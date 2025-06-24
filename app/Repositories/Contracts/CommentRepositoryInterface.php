<?php

namespace App\Repositories\Contracts;

use App\DTO\CommentDTO;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    public function create(CommentDTO $dto): Comment;
    public function index(): Collection;
    public function show(Comment $comment): Comment;
    public function update(Comment $comment, CommentDTO $dto): Comment;
    public function destroy(Comment $comment): bool;
}
