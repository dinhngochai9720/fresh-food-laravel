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
        Schema::table('product_variant_items', function (Blueprint $table) {
            // Change variant_id on product_variant_items table from INT to BIGINT
            $table->unsignedBigInteger('variant_id')->change();

            // Add foreign key (variant_id) to product_variant_items table
            $table->foreign('variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_variant_items', function (Blueprint $table) {
            //
        });
    }
};
