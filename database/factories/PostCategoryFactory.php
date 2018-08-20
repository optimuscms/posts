<?php

use Faker\Generator as Faker;
use Optimus\Posts\Models\PostCategory;

$factory->define(PostCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
    ];
});
