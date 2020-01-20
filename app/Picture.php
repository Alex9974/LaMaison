<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    public function product() {
        // 1 picture ne peut-être rattaché qu'à un seul produit
        return $this->belongsTo(Product::class);
    }
}
