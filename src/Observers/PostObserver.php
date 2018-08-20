<?php

namespace App\Observers;

use Optimus\Posts\Models\Post;

class PostObserver
{
    public function created(Post $post)
    {
        $this->attachCategories($post);

        $this->attachMedia($post);
    }

    public function updated(Post $post)
    {
        $this->syncCategories($post);

        $this->syncMedia($post);
    }

    protected function attachCategories(Post $post)
    {
        $post->categories()->attach(request('categories'));
    }

    protected function syncCategories(Post $post)
    {
        $post->categories()->sync(request('categories'));
    }

    protected function attachMedia(Post $post)
    {
        $post->attachMedia(
            request('image'), 'image', config('post.image_conversions')
        );
    }

    protected function syncMedia(Post $post)
    {
        $post->syncMedia(
            request('image'), 'image', config('post.image_conversions')
        );
    }
}
