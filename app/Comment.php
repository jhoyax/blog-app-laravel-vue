<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'content'
    ];

    /**
     * Get the owning commentable model.
     *
     * @return mixed
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Comment belongs to a user.
     *
     * @return mixed
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the comment's comments.
     *
     * @return mixed
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Get all children of comments.
     *
     * @return mixed
     */
    public function childrenComments()
    {
        return $this->hasMany(Comment::class, 'parent_id')->with('comments');
    }
    

    /**
     * Scope a query to get only parent
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeParent($query)
    {
        return $query->where('parent_id', 0);
    }
}
