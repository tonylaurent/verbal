<?php

use Faker\Generator as Faker;

$factory->define(App\Tag::class, function (Faker $faker) {
    return [
        'name' => ucfirst($faker->word()),
        'description' => $faker->sentence()
    ];
});
