<?php

namespace Optimus\Posts;

use Optix\Draftable\Draftable;

class Post extends Model
{
    use Draftable;

    protected $fillable = [
        'title', 'body', 'published_at', 'has_comments'
    ];

    public function tags()
    {
        return $this->belongsToMany(PostTag::class);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }
}
