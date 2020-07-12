<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Feature;
use Faker\Generator as Faker;

$factory->define(Feature::class, function (Faker $faker) {
    return [
        'baños' => $faker->numberBetween($min = 0, $max = 10),
        'dormitorios' => $faker->numberBetween($min = 0, $max = 8),
        'garage' => $faker->randomElement($array = array ('Si','No')),
        'piscina' => $faker->randomElement($array = array ('Si','No')),
        'otros' => $faker->randomElement($array = array ('Patio Grande','Cocina', 'Jardin')),
    ];
});
