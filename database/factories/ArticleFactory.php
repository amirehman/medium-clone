<?php

use Faker\Generator as Faker;
use App\Article;

$factory->define(Article::class, function (Faker $faker) {

    $title = $faker->sentence;

    return [
        'user_id' => rand(1,10),
        'title' => $title,
        'slug' => str_slug($title),
        'body' => $faker->paragraph,
        'status' => 1
    ];
});

