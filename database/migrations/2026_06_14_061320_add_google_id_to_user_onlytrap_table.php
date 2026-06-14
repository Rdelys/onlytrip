<?php
// database/migrations/xxxx_xx_xx_add_google_id_to_user_onlytrap_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_onlytrap', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('mail');
            $table->boolean('profil_chosen')->default(0)->after('profil'); // pour savoir si l'utilisateur a déjà choisi son profil
        });
    }

    public function down(): void
    {
        Schema::table('user_onlytrap', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'profil_chosen']);
        });
    }
};