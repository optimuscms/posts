<?php

namespace Optimus\Posts\Tests;

use Optimus\Posts\Models\Post;
use Optimus\Posts\Models\PostComment;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_comment_belongs_to_a_post()
    {
        $post = factory(Post::class)->state('published')->create();

        $comment = $post->comments()->save(
            factory(PostComment::class)->make()
        );

        $this->assertInstanceOf(Post::class, $comment->post);
        $this->assertTrue($post->is($comment->post));
    }

    /** @test */
    public function a_comment_is_unapproved_by_default()
    {
        $comment = factory(PostComment::class)->create();

        $this->assertFalse($comment->is_approved);
    }

    /** @test */
    public function a_comment_can_be_approved()
    {
        $comment = factory(PostComment::class)->create();

        $comment->approve();

        $this->assertTrue($comment->is_approved);
    }

    /** @test */
    public function unapproved_comments_are_excluded_by_default()
    {
        $approvedComment = factory(PostComment::class)->state('approved')->create();

        $unapprovedComment = factory(PostComment::class)->create();

        $comments = PostComment::all();

        $this->assertCount(1, $comments);
        $this->assertTrue($comments->first()->is($approvedComment));
    }
}
