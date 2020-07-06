<?php

use Illuminate\Database\Seeder;

class EstablishmentCollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Establishment::class, 1)->create();
    }
}
