<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateCommentRequest;
use App\Models\Comment;
use App\Services\CommentService;

class CommentController extends Controller
{
    private CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function store(StoreUpdateCommentRequest $request)
    {
        return $this->commentService->store($request);
    }

    public function index()
    {
        return $this->commentService->index();
    }

    public function show(Comment $comment)
    {
        return $this->commentService->show($comment);
    }

    public function update(StoreUpdateCommentRequest $request, Comment $comment)
    {
        return $this->commentService->update($request, $comment);
    }

    public function destroy(Comment $comment)
    {
        return $this->commentService->destroy($comment);
    }
}
