<?php

namespace Optimus\Posts\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasSlug;

    protected $fillable = ['name'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
