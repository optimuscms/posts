
<?php

use Faker\Generator as Faker;
use Optimus\Posts\Models\PostComment;

$factory->define(PostComment::class, function (Faker $faker) {
    return [
        'body' => $faker->paragraph,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'website' => $faker->url
    ];
});
