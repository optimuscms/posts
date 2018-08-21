<?php

namespace Optimus\Posts\Tests;

use Optimus\Posts\Models\Post;
use Optimus\Posts\Models\PostComment;
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
    public function a_post_is_draft_by_default()
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
        $publishedPost = factory(Post::class)->state('published')->create();

        $draftPost = factory(Post::class)->create();

        $posts = Post::all();

        $this->assertCount(1, $posts);
        $this->assertTrue($posts->first()->is($publishedPost));
    }

    /** @test */
    public function a_post_generates_a_slug_from_its_title_by_default()
    {
        $post = factory(Post::class)->create(['title' => 'Example Title']);

        $this->assertEquals('example-title', $post->slug);
    }

    /** @test */
    public function a_post_can_have_a_custom_slug()
    {
        $post = factory(Post::class)->create([
            'title' => 'Post Title',
            'slug' => 'post-slug'
        ]);

        $this->assertEquals('post-slug', $post->slug);
    }

    /** @test */
    public function a_post_generates_a_unique_slug()
    {
        $postOne = factory(Post::class)->create(['title' => 'Duplicate Title']);
        $postTwo = factory(Post::class)->create(['title' => 'Duplicate Title']);

        $this->assertNotEquals($postOne->slug, $postTwo->slug);
    }

//    /** @test */
//    public function a_post_can_have_media()
//    {
//
//    }

    /** @test */
    public function a_post_can_have_comments()
    {
        $post = factory(Post::class)->create();

        $comments = $post->comments()->saveMany(
            factory(PostComment::class, 3)->make(['is_approved' => true])
        );

        $this->assertInstanceOf(
            EloquentCollection::class, $post->comments
        );

        $comments->assertEquals($post->comments);
    }
}
