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
            $table->string('subcategory');
            $table->string('name')->unique();
            $table->string('brand'); // Add 'brand' column
            $table->string('slug');
            $table->integer('quantity');
            $table->string('unit_of_measure');
            $table->decimal('price', 10, 2);
            $table->string('description')->nullable();
            $table->string('image');
            $table->timestamps();
        
            $table->unique(['category_id', 'name']);
            $table->foreign('category_id')->references('id')->on('categories');
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
