<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    // Storage::disk('local')->delete(Storage::allFiles());    
    $link = Str::random(12) . '.jpg'; // hash de lien pour la sécurité (injection de scripts protection)
    $file = file_get_contents('https://picsum.photos/id/'.rand(1, 10).'/600/750'); // flux
    Storage::disk('local')->put($link, $file);
    return [
        'category_id' => $faker->numberBetween($min = 1, $max = 2),
        'title_product' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'description' => $faker->text($maxNbChars = 200),
        'price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 4000),
        'size' => $faker->randomElement($array = array ('46', '46 48', '46 48 50', '46 48 50 52', '48', '48 50', '48 50 52', '50', '50 52', '52')),
        'url_image' => $link,
        'status' => $faker->randomElement($array = array ('publie', 'brouillon')),
        'code' => $faker->randomElement($array = array ('solde', 'new')),
        'reference' => $faker->numberBetween($min = 100000, $max = 999999)
    ];
});
