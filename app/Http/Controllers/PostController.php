<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
class PostController extends Controller
{
    public function store(StoreUpdatePostRequest $request)
    {

        $dto = $request->toDTO();
        $post = Post::create($dto->toArray());
        return response()->json([
            'post' => new PostResource($post)
        ], 201);
    }

    public function index()
    {
        $posts = PostResource::collection(Post::with('user')->get());
        return response()->json([
            'posts' => $posts
        ]);
    }

    public function show(Post $post) {
        return new PostResource($post);
    }

    public function update(StoreUpdatePostRequest $request, Post $post) {

        $dto = $request->toDTO();
        $post->update($dto->toArray());

        return new PostResource($post);
    }

    public function destroy(Post $post) {
        $post->delete();
        return response()->noContent();
    }
}
