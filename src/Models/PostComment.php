<?php

namespace Optimus\Posts\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class PostComment extends Model
{
    protected $casts = [
        'is_approved' => 'bool'
    ];

    protected $fillable = [
        'body', 'name', 'email', 'website', 'is_approved'
    ];

    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope('approved', function ($query) {
            $query->where('is_approved', true);
        });
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function approve()
    {
        $this->is_approved = true;
        $this->save();
    }
}
