<?php

namespace Optimus\Posts;

class PostComment extends Model
{
    protected $fillable = [];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
