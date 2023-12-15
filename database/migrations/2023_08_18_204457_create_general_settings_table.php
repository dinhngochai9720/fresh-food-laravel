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
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name');
            $table->text('logo');
            $table->text('logo_footer');
            $table->text('favicon_icon');
            $table->string('email_contact');
            $table->string('phone_contact');
            $table->text('address');
            $table->text('facebook_link')->nullable();
            $table->text('youtube_link')->nullable();
            $table->text('instagram_link')->nullable();
            $table->string('currency_name');
            $table->string('currency_icon');
            $table->string('time_zone');
            $table->string('copyright');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_settings');
    }
};
