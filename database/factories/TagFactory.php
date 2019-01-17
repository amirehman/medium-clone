<?php

use Faker\Generator as Faker;
use App\Tag;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'slug' => str_slug($faker->word)
    ];
});

