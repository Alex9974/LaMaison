<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// modèle de la table catégories en lien avec la table products
class Categorie extends Model
{
    public function products() {
        // 1 catégorie (Homme et Femme) peut avoir plusieurs produits
        return $this->hasMany(Product::class);
    }
}
