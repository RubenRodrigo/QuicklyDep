<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'apellido' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'fecha_nacimiento' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'numero' => $faker->tollFreePhoneNumber,
        'tipo' => $faker->randomElement($array = array ('Normal','Premiun')),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
