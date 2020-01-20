<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{

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


        //creation de 50 entrées dans la table "products"    
        factory(App\Product::class, 50)->create()->each(function($product){

            for($i = 0; $i < 4 ; $i++) {
                // ajout des images
                // On utilise futurama sur lorempicsum pour récupérer des images aléatoirement
                // attention il n'y en a que 9 en tout différentes
                $link = Str::random(12) . '.jpg';
                // utilisation d'un générateur automatique d'images
                $file = file_get_contents('https://picsum.photos/id/'.rand(10, 85).'/600/750');
                // enregistrement dans le dossier public > images
                Storage::disk('local')->put($link, $file);

                $product->pictures()->create([
                    'picture' => $link,
                    'order' => $i+1,
                ]);                
            } 
        });
    }
}
