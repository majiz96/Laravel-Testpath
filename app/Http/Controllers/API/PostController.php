<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    //

    public function index()
    {
        $perPage = min(request('perPage', 5), 100);

        return PostResource::collection(Post::paginate($perPage));
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function store(PostStoreRequest $request)
    {

        $post = Post::create($request->validated());

        return new PostResource($post);
    }

    public function update(PostUpdateRequest $request, Post $post)
    {

        $post->update($request->validated());

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json("The (({$post->title})) post deleted successfully", 200);
    }


}
