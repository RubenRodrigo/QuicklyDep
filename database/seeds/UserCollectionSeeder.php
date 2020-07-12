<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\User;

class UserCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 10)
            ->create()
            ->each( function ($user){
                $user->posts()->createMany(
                    factory(App\Post::class, 2)->make()->toArray()
                )
                ->each( function($post){
                    $post->establishment()->createMany(
                        factory(App\Establishment::class, 1)->make()->toArray()
                    );
                });  
            });

            User::create([
                'name' => 'rodrigo',
                'email' => 'rodrigohde905@gmail.com',
                'email_verified_at' => now(),                
                'fecha_nacimiento' => '2015-06-16',
                'numero' => '916148132',
                'rol' => 'c',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                'remember_token' => Str::random(10),
            ]);
    }
}
