<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_id');
            $table->integer('user_id');
            $table->double('total_price');
            $table->double('final_total_price');
            $table->double('shipping_fee');
            $table->double('discount');
            $table->string('currency_name');
            $table->string('currency_icon');
            $table->string('payment_method');
            $table->integer('payment_status');
            $table->text('shipping');
            $table->text('coupon');
            $table->text('address');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
