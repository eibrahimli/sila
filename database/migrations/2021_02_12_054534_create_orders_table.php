<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->text('cart');
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('adress');
            $table->string('number');
            $table->string('city');
            $table->string('note',500)->nullable();
            $table->enum('status', [0,1,2,3])->default(0);
            $table->boolean('active')->default(0);
            $table->unsignedBigInteger('total_quantity');
            $table->unsignedBigInteger('total_price');
            $table->string('payment_method')->default('bank');
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
        Schema::dropIfExists('orders');
    }
}
