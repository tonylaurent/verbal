<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $image = $faker->file(
        resource_path('tests/photos'), 
        storage_path('app/public/tmp'), 
        false
    );
    
    return [
        'title' => $faker->sentence(),
        'summary' => $faker->paragraph(5, false),
        'content' => $faker->text(2000),
        'image' => "tmp/{$image}"
    ];
});
