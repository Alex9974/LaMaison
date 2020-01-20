<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    
    // création de la table pictures
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            // clé secondaire qui fait référence à la clé primaire de la table products
            $table->unsignedBigInteger('product_id');
            $table->string('picture', 100);
            $table->unsignedInteger('order');
            // lien entre tables pictures et products par la clé secondaire product_id et la clé primaire id
            $table->foreign('product_id')->references('id')->on('products')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pictures');
    }
}
