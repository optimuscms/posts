
<?php

use Faker\Generator as Faker;
use Optimus\Posts\Models\Post;
use Optimus\Posts\Models\PostComment;

$factory->define(PostComment::class, function (Faker $faker) {
    return [
        'post_id' => function () {
            return factory(Post::class)->state('published')->create()->id;
        },
        'body' => $faker->paragraph,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'website' => $faker->url,
        'is_approved' => false
    ];
});

$factory->state(PostComment::class, 'approved', function (Faker $faker) {
    return [
        'is_approved' => true
    ];
});
