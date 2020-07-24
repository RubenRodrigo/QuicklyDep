<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Establishment;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

$factory->define(Establishment::class, function (Faker $faker) {
    $user_id = App\User::all()->random()->id;

    // Obtenemos y guardamos en un array, con su direccion, todas las images de casasPrueba
    $imagesDir= scandir('public/casasPrueba/');
    $images = array();
    for ($i=2; $i < sizeof($imagesDir); $i++) { 
        $images[] = "public/casasPrueba/".$imagesDir[$i];
    }

    // Guardamos creamos las imagenes
    $image = $faker->randomElement($images);
    $imageFile = new File($image);
    $image1 = $faker->randomElement($images);
    $imageFile1 = new File($image1);
    $image2 = $faker->randomElement($images);
    $imageFile2 = new File($image2);
    $image3 = $faker->randomElement($images);
    $imageFile3 = new File($image3);
    $image4 = $faker->randomElement($images);
    $imageFile4 = new File($image4);

    $imagenes = array();
    $imagenes[] = Storage::disk('public')->putFile('posts/', $imageFile);
    $imagenes[] = Storage::disk('public')->putFile('posts/', $imageFile1);
    $imagenes[] = Storage::disk('public')->putFile('posts/', $imageFile2);
    $imagenes[] = Storage::disk('public')->putFile('posts/', $imageFile3);
    $imagenes[] = Storage::disk('public')->putFile('posts/', $imageFile4);
    $distritos = array("Distrito de Alto Selva", "Arequipa", "Cayma","Cerro Colorado","Characato","Chiguata","Jacobo","Hunter","José Luis Bustamante y Rivero","La Joya","Mariano Melgar","Miraflores","Mollebaya","Paucarpata","Pocsi","Polobaya","Quequeña", "Sabandía", "Sachaca", "San Juan de Siguas", "San Juan de Tarucani", "Santa Isabel de Siguas","Santa Rita de Siguas","Socabaya", "Tiabaya","Uchumayo","Vítor", "Yanahuara", "Yarabamba", "Yura");
    return [
        'pais' => "Perú",
        'ciudad' => "Arequipa",
        'distrito' => $faker->randomElement($distritos),
        'direccion' => $faker->address(),        
        'precio' => $faker->numberBetween($min = 0),
        'imagen' => $imagenes,
    ];
});
