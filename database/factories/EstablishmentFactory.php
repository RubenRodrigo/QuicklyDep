<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Establishment;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

$factory->define(Establishment::class, function (Faker $faker) {
    $user_id = App\User::all()->random()->id;
    $image = $faker->image();
    $imageFile = new File($image);
    return [
        'precio' => $faker->numberBetween($min = 0, $max = 90000),
        'imagen' => Storage::disk('public')->putFile('posts/'.$user_id, $imageFile),
    ];
});
