<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function products() {
        // 1 produit ne peut-être rattaché qu'à une seule catégorie (Homme ou Femme)
        return $this->belongsTo(Categorie::class);
    }
}
