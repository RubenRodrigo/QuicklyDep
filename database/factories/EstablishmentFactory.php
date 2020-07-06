<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Establishment;
use Faker\Generator as Faker;

$factory->define(Establishment::class, function (Faker $faker) {
    return [
        'precio' => $faker->numberBetween($min = 500, $max = 90000),
        'imagen' => $faker->imageUrl($width = 640, $height = 480) 
    ];
});
