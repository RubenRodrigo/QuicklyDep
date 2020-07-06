<?php

use Illuminate\Database\Seeder;

class PostCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class, 5)->create();
        // $posts = factory(App\Post::class, 10)
        // ->create()
        // ->each( function ($post){
        //     $post->establishments()->createMany(
        //         factory(App\Establishment::class, 1)->make()->toArray()
        //     );  
        // });
    }
}
