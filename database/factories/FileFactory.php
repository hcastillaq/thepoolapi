<?php

use Faker\Generator as Faker;

$factory->define(App\File::class, function (Faker $faker) {
    return [
        'name' => $faker->imageUrl(400, 400, 'cats'),
        'description' => $faker->text,
        'ext' => 'jpg',
    ];
});
