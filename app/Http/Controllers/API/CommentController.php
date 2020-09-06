<?php

namespace App\Http\Controllers\API;

use App\Post;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommentIndexRequest;
use App\Http\Resources\CommentResource;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Http\Resources\CommentCollection;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\CommentIndexRequest  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(CommentIndexRequest $request)
    {
        $user = $request->user();

        $perPage = $request->input('per_page', 10);
        $comments = Comment::parent()
                    ->commentable($request->input('commentable_type'), $request->input('commentable_id'))
                    ->orderBy('created_at', 'desc')
                    ->with('childrenComments')
                    ->paginate($perPage);

        return new CommentCollection($comments);
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

        $types = [
            'post' => Post::class
        ];
        if (!array_key_exists($request->input('commentable_type'), $types)) {
            abort(404);
        }

        $model = $types[$request->input('commentable_type')]::find($request->input('commentable_id'));
        $model->comments()->save($comment);
        
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
