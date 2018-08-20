<?php

namespace Optimus\Posts\Models;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = [
        'body', 'author_name', 'author_email', 'author_website', 'is_approved'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function approve()
    {
        $this->update(['is_approved' => true]);
    }
}
