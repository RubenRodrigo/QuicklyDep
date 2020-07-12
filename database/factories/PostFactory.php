<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Establishment;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    
    return [
        'nombre' => $faker->sentence(5),
        'descripcion' => $faker->paragraph(3),
        'tipo' => $faker->randomElement($array = array ('Alquiler','Venta')),
        // 'establecimiento' => function(){
        //     return factory(Establishment::class)->create();
        // }
    ];
});
