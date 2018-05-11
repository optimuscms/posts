<?php

namespace Optimus\Posts;

use Optix\Publishable\Publishable;

class Post extends Model
{
    use Publishable;

    protected $fillable = ['title', 'body', 'published_at', 'has_comments'];

    public function author()
    {
        return $this->belongsTo(AdminUser::class);
    }

    public function tags()
    {
        return $this->belongsToMany(PostTag::class);
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }
}
