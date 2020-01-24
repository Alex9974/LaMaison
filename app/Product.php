<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// modèle de la table products en lien avec les tables categories et pictures
class Product extends Model
{
    public function categorie() {
        // 1 produit ne peut-être rattaché qu'à une seule catégorie (Homme ou Femme)
        return $this->belongsTo(Categorie::class);
    }

    public function pictures() {
        // 1 produit peut avoir plusieurs pictures (4 pour l'exercice)
        return $this->hasMany(Picture::class);
    }
}
