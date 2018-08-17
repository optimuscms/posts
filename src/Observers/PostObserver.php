<?php

namespace App\Observers;

use Illuminate\Http\Request;
use Optimus\Posts\Models\Post;

class PostObserver
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function created(Post $post)
    {
        $post->categories()->attach(
            $this->request->input('categories')
        );

        $post->attachMedia(
            $this->request->input('image'), 'image',
            (array) config('post.image_conversions')
        );
    }

    public function updated(Post $post)
    {
        $post->categories()->sync(
            $this->request->input('categories')
        );

        $post->syncMedia(
            $this->request->input('image'), 'image',
            (array) config('post.image_conversions')
        );
    }
}
