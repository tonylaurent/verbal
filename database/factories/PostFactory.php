<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'summary' => $faker->paragraph(5, false),
        'content' => $faker->text(2000)
    ];
});
