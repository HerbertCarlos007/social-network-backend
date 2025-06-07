<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
class PostController extends Controller
{
    public function store(StoreUpdatePostRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $post = Post::create($data);

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
        $data = $request->validated();
        $post->update($data);
        return new PostResource($post);
    }

    public function destroy(Post $post) {
        $post->delete();
        return response()->noContent();
    }
}
