<?php

namespace Optimus\Posts\Tests;

use Optimus\Posts\Models\Post;
use Optimus\Posts\Models\PostCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_post_belongs_to_many_categories()
    {
        $post = factory(Post::class)->create();

        $categories = factory(PostCategory::class, 3)->create();

        $post->categories()->attach($categories);

        $this->assertInstanceOf(
            EloquentCollection::class, $post->categories
        );

        $categories->assertEquals($post->categories);
    }

    /** @test */
    public function a_post_is_made_draft_by_default()
    {
        $post = factory(Post::class)->create();

        $this->assertFalse($post->isPublished());
    }

    /** @test */
    public function a_post_can_be_published()
    {
        $postOne = factory(Post::class)->create([
            'published_at' => now()
        ]);

        $this->assertTrue($postOne->isPublished());

        $postTwo = factory(Post::class)->create();
        $postTwo->publish();

        $this->assertTrue($postTwo->isPublished());
    }

    /** @test */
    public function draft_posts_are_excluded_by_default()
    {
        $publishedPost = factory(Post::class)->create([
            'published_at' => now()
        ]);

        $draftPost = factory(Post::class)->create();

        $posts = Post::all();

        $this->assertCount(1, $posts);
        $this->assertTrue($posts->first()->is($publishedPost));
    }
}
