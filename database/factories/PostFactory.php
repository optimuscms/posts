<?php

use Faker\Generator as Faker;
use Optimus\Posts\Models\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'excerpt' => $faker->paragraph,
        'body' => $faker->paragraph(5)
    ];
});

$factory->state(Post::class, 'published', function (Faker $faker) {
    return [
        'published_at' => now()
    ];
});
