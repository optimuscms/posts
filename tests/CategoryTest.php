<?php

namespace Optimus\Posts\Tests;

use Optimus\Posts\Models\Post;
use Optimus\Posts\Models\PostCategory;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_category_belongs_to_many_posts()
    {
        $category = factory(PostCategory::class)->create();

        $category->posts()->attach(
            $posts = factory(Post::class, 3)->create()
        );

        $this->assertInstanceOf(
            EloquentCollection::class, $category->posts
        );

        $posts->assertEquals($posts, $category->posts);
    }

    /** @test */
    public function a_category_generates_a_slug_from_its_name()
    {
        $category = factory(PostCategory::class)->create([
            'name' => 'Category Name'
        ]);

        $this->assertEquals('category-name', $category->slug);
    }

    /** @test */
    public function a_category_can_have_a_custom_slug()
    {
        $category = factory(PostCategory::class)->create([
            'name' => 'Category Name',
            'slug' => 'category-slug'
        ]);

        $this->assertEquals('category-slug', $category->slug);
    }

    /** @test */
    public function a_category_generates_a_unique_slug()
    {
        $categoryOne = factory(PostCategory::class)->create(['name' => 'Duplicate Name']);
        $categoryTwo = factory(PostCategory::class)->create(['name' => 'Duplicate Name']);

        $this->assertNotEquals($categoryOne->slug, $categoryTwo->slug);
    }
}
