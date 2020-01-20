<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

// pour la création de produits Faker de la table products
$factory->define(Product::class, function (Faker $faker) { 
    
    return [
        'category_id' => $faker->numberBetween($min = 1, $max = 2),
        'title_product' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'description' => $faker->text($maxNbChars = 800),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 4000),
        'size' => $faker->randomElement($array = array ('46', '46 48', '46 48 50', '46 48 50 52', '48', '48 50', '48 50 52', '50', '50 52', '52')),
        'status' => $faker->randomElement($array = array ('publie', 'brouillon')),
        'code' => $faker->randomElement($array = array ('solde', 'new')),
        'reference' => $faker->numberBetween($min = 100000, $max = 999999)
    ];
});
