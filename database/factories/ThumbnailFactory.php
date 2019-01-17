<?php

use Faker\Generator as Faker;
use App\Thumbnail;

$factory->define(Thumbnail::class, function (Faker $faker) {

    $dir= 'public/images';
    $width = 400;
    $height = 300;

    return [
        "blur" =>  $faker->image($dir, $width, $height, 'cats', false),
        "small" =>  $faker->image($dir, $width, $height, 'cats', false),
        "medium" =>  $faker->image($dir, $width, $height, 'cats', false),
        "large" =>  $faker->image($dir, $width, $height, 'cats', false),
        "article_id" =>  rand(1,10),
        "article_type" => "post",
    ];
});


