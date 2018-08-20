<?php

namespace Optimus\Posts\Models;

use App\Observers\PostObserver;
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

    protected $fillable = ['title', 'excerpt', 'body'];

    protected static function boot()
    {
        parent::boot();

        Post::observe(PostObserver::class);
    }

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

    public function isPublished()
    {
        return ! is_null($this->published_at) && $this->published_at <= now();
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
