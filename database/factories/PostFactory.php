<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Post::class, function (Faker $faker) {
    $cat = ['cat1', 'cat2', 'cat3'];
    return [
        'title' => $faker->realText($maxNbChars = 80, $indexSize = 2),
        'description' => $faker->realText($maxNbChars = 160, $indexSize = 2),
        'tags' => implode( [ $cat[array_rand( $cat ) ] . ',', $cat[array_rand( $cat )] ] ),
    ];
});
