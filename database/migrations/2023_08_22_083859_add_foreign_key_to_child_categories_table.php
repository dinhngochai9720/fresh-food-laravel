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
        Schema::table('child_categories', function (Blueprint $table) {
            // Change sub_category_id on child_categories table from INT to BIGINT
            $table->unsignedBigInteger('sub_category_id')->change();
            // Add foreign key (sub_category_id) to child_categories table
            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('child_categories', function (Blueprint $table) {
            //
        });
    }
};
