<?php

namespace App\Http\Controllers\API;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Traits\HasUpload;

class PostController extends Controller
{
    use HasUpload;

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $posts = Post::orderBy('created_at', 'desc')->paginate($perPage);

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostStoreRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        $user = $request->user();
        $data = $request->only(['title', 'content']);
        if ($image = $request->file('image')) {
            $data['image'] = $this->storeFile($image);
        }

        $post = $user->posts()->create($data);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostUpdateRequest  $request
     * @param  \App\Post  $post
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, Post $post)
    {
        $oldImage = $post->image;

        $post->title = $request->input('title');
        $post->content = $request->input('content');

        if ($image = $request->file('image')) {
            $post->image = $this->storeFile($image);
            $this->deleteFile($oldImage);
        }

        $post->save();

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return $post->delete();
    }
}
