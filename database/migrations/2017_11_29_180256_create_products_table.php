<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('category');
            $table->boolean('visible');
            $table->integer('price');
            $table->string('name');
            $table->string('brand')->nullable();
            $table->integer('discount_id')->nullable();
            $table->integer('counter_ratind')->nullable();
            $table->integer('sum_rating')->nullable();
            $table->timestamps();

            $table->foreign('category')
                ->references('slug')
                ->on('categories')
                ->onDelete('cascade');
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
