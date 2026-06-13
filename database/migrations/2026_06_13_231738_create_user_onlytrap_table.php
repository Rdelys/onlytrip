<?php
// database/migrations/xxxx_xx_xx_create_user_onlytrap_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_onlytrap', function (Blueprint $table) {
            $table->id();
            $table->string('mail')->unique();
            $table->tinyInteger('profil')->default(1); // 1 = voyageur, 0 = local
            $table->string('otp_code', 6)->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_onlytrap');
    }
};