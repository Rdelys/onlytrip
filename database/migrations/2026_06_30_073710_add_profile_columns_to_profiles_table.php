<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_onlytrap', function (Blueprint $table) {
            // Status
            $table->string('status', 20)->default('inactif')->after('profil_chosen');

            // Identity
            $table->string('nom', 100)->nullable()->after('status');
            $table->string('prenom', 100)->nullable()->after('nom');
            $table->string('pseudo', 80)->nullable()->unique()->after('prenom');
            $table->date('date_naissance')->nullable()->after('pseudo');

            // Sexe : déterminé uniquement par DeepFace (jamais saisi manuellement).
            // varchar libre pour ne pas être bloqué par un enum si DeepFace renvoie
            // une valeur inattendue.
            $table->string('sexe', 30)->nullable()->after('date_naissance');

            // Contact
            $table->string('telephone', 30)->nullable()->after('sexe');

            // Media
            $table->string('photo_profil')->nullable()->after('telephone');

            // Interests (stored as JSON array)
            $table->json('centres_interet')->nullable()->after('photo_profil');

            // Local-only fields
            $table->text('bio')->nullable()->after('centres_interet');
            $table->decimal('classement_etoile', 3, 2)->nullable()->after('bio'); // e.g. 4.75
        });
    }

    public function down(): void
    {
        Schema::table('user_onlytrap', function (Blueprint $table) {
            $table->dropColumn([
                'status', 'nom', 'prenom', 'pseudo', 'date_naissance',
                'sexe', 'telephone', 'photo_profil', 'centres_interet',
                'bio', 'classement_etoile',
            ]);
        });
    }
};