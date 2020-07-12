<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Establishment;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

$factory->define(Establishment::class, function (Faker $faker) {
    $user_id = App\User::all()->random()->id;
    $image = $faker->image();
    $imageFile = new File($image);    
    return [
        'pais' => $faker->country(),
        'ciudad' => $faker->city(),
        'distrito' => "Arequipa",
        'direccion' => $faker->address(),        
        'precio' => $faker->numberBetween($min = 0),
        'imagen' => Storage::disk('public')->putFile('posts/', $imageFile),      
    ];
});
