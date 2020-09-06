<?php

namespace App\Http\Controllers\API;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 10);

        return CommentResource::collection(Comment::parent()->with('childrenComments')->paginate($page));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CommentStoreRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request)
    {
        $user = $request->user();
        $comment = $user->comments()->create($request->toArray());

        $post = Post::find($request->input('post_id'));
        $post->comments()->save($comment);
        
        return new CommentResource($comment);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CommentUpdateRequest  $request
     * @param  \App\Comment  $comment
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request, Comment $comment)
    {
        $comment->content = $request->input('content');
        $comment->save();

        return new CommentResource($comment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}
