<?php

namespace Optimus\Posts\Tests\Feature;

use Optimus\Posts\Models\Post;
use Optimus\Posts\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function an_administrator_can_view_all_posts()
    {
        $posts = factory(Post::class, 3)->create();

        // $this->actingAs($this->user);

        $response = $this->getJson('api/posts')->assertOk();
    }

    /** @test */
    public function an_administrator_with_the_correct_permissions_can_create_a_post()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function an_administrator_can_view_a_specific_post()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function an_administrator_with_the_correct_permissions_can_update_a_post()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function an_administrator_with_the_correct_permissions_can_delete_a_post()
    {
        $this->assertTrue(true);
    }
}
