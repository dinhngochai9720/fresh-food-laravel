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
        Schema::table('flash_sale_items', function (Blueprint $table) {
            // Change product_id on flash_sale_items table from INT to BIGINT
            $table->unsignedBigInteger('product_id')->change();
            
            // Add foreign key (product_id) to flash_sale_items table
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('flash_sale_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });
    }
};
