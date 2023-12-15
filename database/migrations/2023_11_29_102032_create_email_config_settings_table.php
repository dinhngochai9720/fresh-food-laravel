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
        Schema::create('email_config_settings', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('mail_host');
            $table->string('username_smtp');
            $table->string('password_smtp');
            $table->string('mail_port');
            $table->string('mail_encryption');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_config_settings');
    }
};
