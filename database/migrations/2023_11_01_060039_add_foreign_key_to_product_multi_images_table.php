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
        Schema::table('product_multi_images', function (Blueprint $table) {
            // Change product_id on product_multi_images table from INT to BIGINT
            $table->unsignedBigInteger('product_id')->change();

            // Add foreign key (product_id) to product_multi_images table
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_multi_images', function (Blueprint $table) {
            //
        });
    }
};
