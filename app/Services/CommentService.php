<?php

namespace App\Services;

use App\Http\Requests\StoreUpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentService
{
    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    public function store(StoreUpdateCommentRequest $request)
    {
        $dto = $request->toDTO();
        $comment = $this->commentRepository->create($dto);
        return new  CommentResource($comment);
    }

    public function index()
    {
        $comments = $this->commentRepository->index();
        return  CommentResource::collection($comments);
    }

    public function show(Comment $comment): CommentResource
    {
        $comment = $this->commentRepository->show($comment);
        return new CommentResource($comment);
    }

    public function update(StoreUpdateCommentRequest $request, Comment $comment): CommentResource
    {
        $dto = $request->toDTO();
        $comment = $this->commentRepository->update($comment, $dto);
        return new CommentResource($comment);
    }

    public function destroy(Comment $comment): bool
    {
        return $this->commentRepository->destroy($comment);

    }
}
