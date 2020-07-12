<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Adress;
use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Adress::class, function (Faker $faker) {
    $posts = Post::all();
    $user_id = App\User::all()->random()->id;
    $image = $faker->image();
    $imageFile = new File($image);
    return [        
        'ciudad' => $faker->city(),
        'distrito' => $faker->district(),
        'direccion' => $faker->adress(),        
        'precio' => $faker->numberBetween($min = 0),
        'imagen' => Storage::disk('public')->putFile('posts/'.$user_id, $imageFile),
    ];
});
