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
    $distritos = array("Distrito de Alto Selva", "Arequipa", "Cayma","Cerro Colorado","Characato","Chiguata","Jacobo","Hunter","José Luis Bustamante y Rivero","La Joya","Mariano Melgar","Miraflores","Mollebaya","Paucarpata","Pocsi","Polobaya","Quequeña", "Sabandía", "Sachaca", "San Juan de Siguas", "San Juan de Tarucani", "Santa Isabel de Siguas","Santa Rita de Siguas","Socabaya", "Tiabaya","Uchumayo","Vítor", "Yanahuara", "Yarabamba", "Yura");
    return [
        'pais' => "Perú",
        'ciudad' => "Arequipa",
        'distrito' => $faker->randomElement($distritos),
        'direccion' => $faker->address(),        
        'precio' => $faker->numberBetween($min = 0),
        'imagen' => Storage::disk('public')->putFile('posts/', $imageFile),      
    ];
});
