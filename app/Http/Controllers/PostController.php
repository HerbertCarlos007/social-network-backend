<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

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
        $posts = Post::all();
        return PostResource::collection($posts);
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
