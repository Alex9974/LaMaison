<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        //creation des données fixes de la table "categories"
        App\Categorie::create([
            'title_category' => 'Homme', 
            'description' => 'Produits pour les hommes'
        ]);
        App\Categorie::create([
            'title_category' => 'Femme', 
            'description' => 'Produits pour les femmes'
        ]);


        //creation de 20 entrées dans la table "products"    
        factory(App\Product::class, 50)->create();
    }
}
