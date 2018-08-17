<?php

namespace Optimus\Posts\Models;

use Optix\Media\HasMedia;
use Illuminate\Http\Request;
use Spatie\Sluggable\HasSlug;
use Optix\Draftable\Draftable;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasMedia, HasSlug, Draftable, SoftDeletes;

    protected $dates = ['published_at'];

    protected $fillable = [
        'title', 'body', 'published_at'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function scopeLatest(Builder $query)
    {
        $query->orderBy('published_at', 'desc');
    }

    public function scopeFilter(Builder $query, Request $request)
    {
        //
    }

    public function categories()
    {
        return $this->belongsToMany(
            PostCategory::class, 'post_category', 'post_id', 'category_id'
        );
    }

    public function comments()
    {
        return $this->hasMany(PostComment::class);
    }
}
