<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('user_id')->index();
            $table->string('seller_id');
            $table->string('address');
            $table->string('order_no')->unique();
            $table->string('city');
            $table->float('amount');
            $table->boolean('delivery_status')->default(false);
            $table->boolean('payment_status')->default(false);
            $table->string('CheckoutRequestID');
            $table->string('MerchantRequestID');
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
