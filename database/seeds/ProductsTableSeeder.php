<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{

    public function run()
    {
        
        // creation des données fixes de la table "categories"
        App\Categorie::create([
            'title_category' => 'Homme', 
            'description' => 'Produits pour les hommes'
        ]);

        App\Categorie::create([
            'title_category' => 'Femme', 
            'description' => 'Produits pour les femmes'
        ]);

        // creation de 2 membres dans la table "users"  
        // un membre administrateur (role = 1) qui pourra avoir accés au back office grâce à la mise ne place du middleware admin
        App\User::create([
            'role' => 1, 
            'name' => 'Alexandre75',
            'email' => 'admin@hotmail.fr',
            'password' => Hash::make('admin'),
        ]);

        // un membre non administrateur (role = 0) qui ne pourra pas accéder au back office 
        App\User::create([
            'role' => 0, 
            'name' => 'Ragois75',
            'email' => 'auth@hotmail.fr',
            'password' => Hash::make('auth'),
        ]);


        //creation de 50 entrées dans la table "products"    
        factory(App\Product::class, 50)->create()->each(function($product){

            // ajout de 4 images dans la table pictures pour chaque produit créé 
            for($i = 0; $i < 4 ; $i++) {
                // hash de lien pour la sécurité
                $link = Str::random(12) . '.jpg';
                // utilisation d'un générateur automatique d'images picsum
                $file = file_get_contents('https://picsum.photos/id/'.rand(10, 85).'/600/750');
                // enregistrement dans le dossier public > images
                Storage::disk('local')->put($link, $file);

                // création des 4 images : envoi des données dans la table pictures avec attribution d'un numéro d'ordre de 1 à 4 pour chaque lot d'images associées à 1 produit
                $product->pictures()->create([
                    'picture' => $link,
                    'order' => $i+1,
                ]);                
            } 
        });
    }
}
