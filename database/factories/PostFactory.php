<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Establishment;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'nombre' => $faker->sentence(5),
        'descripcion' => $faker->paragraph(3),
        'tipo' => $faker->sentence(1),
        // 'establecimiento' => function(){
        //     return factory(Establishment::class)->create();
        // }
    ];
});
