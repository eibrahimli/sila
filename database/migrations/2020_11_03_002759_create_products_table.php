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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->string('title', 256);
            $table->text('desc')->nullable();
            $table->string('keyw', 256)->nullable();
            $table->integer('category_id')->default(0);
            $table->integer('store_id')->default(0);
            $table->string('lang')->default('az');
            $table->double('price');
            $table->integer('stock')->nullable();
            $table->string('ral')->nullable();
            $table->string('spec',1000)->nullable();
            $table->string('brand_id')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status',[0,1])->default(0);
            $table->unsignedBigInteger('sold')->default(0);
            $table->unsignedBigInteger('ordered')->default(0);
            $table->unsignedBigInteger('seen')->default('0');
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
        Schema::dropIfExists('product');
    }
}
