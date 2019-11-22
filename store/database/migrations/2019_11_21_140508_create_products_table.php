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
            $table->string('product_id');
            $table->string('title')->nullable();
            $table->string('artist')->nullable();
            $table->integer('year')->nullable();
            $table->string('director')->nullable();
            $table->string('album')->nullable();
            $table->integer('price');
            $table->string('store');
            $table->string('thumb');
            $table->string('date');
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
