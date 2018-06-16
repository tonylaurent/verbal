<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;

$factory->define(App\Post::class, function (Faker $faker) {
    $directoryName = 'fake';
    
    Storage::disk('public')->makeDirectory($directoryName);
    
    $image = $faker->file(
        resource_path('tests/photos'), 
        storage_path("app/public/{$directoryName}"), 
        false
    );
    
    return [
        'title' => $faker->sentence(),
        'summary' => $faker->paragraph(5, false),
        'content' => $faker->text(2000),
        'image' => "{$directoryName}/{$image}"
    ];
});
