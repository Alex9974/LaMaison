<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->string('title_product', 100);
            $table->text('description');
            $table->decimal('price', 8, 2);
            $table->enum('size', ['46', '46 48', '46 48 50', '46 48 50 52', '48', '48 50', '48 50 52', '50', '50 52', '52']);
            $table->string('url_image', 100);
            $table->enum('status', ['publie', 'brouillon']);
            $table->enum('code', ['solde', 'new']);
            $table->integer('reference');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('products');
    }
}
