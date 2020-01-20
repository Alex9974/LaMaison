<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // injection des données fakers dans les tables products et catégories
        $this->call(ProductsTableSeeder::class);
    }
}
