<?php

namespace Optimus\Posts\Tests;

use Optimus\Posts\Models\Post;
use Optimus\Posts\Models\PostCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_belongs_to_many_categories()
    {
        $post = factory(Post::class)->create();

        $categories = factory(PostCategory::class, 3)->create();

        $post->categories()->attach($categories);

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection', $post->categories
        );

        $categories->assertEquals($post->categories);
    }
}
