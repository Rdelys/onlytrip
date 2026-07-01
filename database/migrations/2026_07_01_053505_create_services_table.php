<?php
// database/migrations/2025_07_01_000001_create_services_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Relation au local
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('user_onlytrap')
                  ->onDelete('cascade');

            // Infos principales
            $table->string('titre', 200);
            $table->text('description');
            $table->string('categorie', 100);          // Gastronomie, Nature, Culture…
            $table->decimal('tarif', 10, 2);
            $table->enum('type_tarif', [
                'heure',
                'demi-journee',
                'journee',
                'semaine',
                'mois',
                'personne',
                'forfait',
            ])->default('journee');

            // Infos complémentaires
            $table->text('bonus')->nullable();          // Ce qui est inclus
            $table->string('duree', 150)->nullable();   // "3 heures", "Journée complète"…
            $table->string('langues', 250)->nullable();
            $table->unsignedSmallInteger('max_personnes')->nullable();

            // Localisation (sécurité : adresse précise volontairement absente)
            $table->string('ville', 100)->nullable();
            $table->string('pays', 100)->nullable();

            // Médias
            $table->json('photos')->nullable();         // Tableau de chemins Storage

            // Statut
            $table->boolean('disponible')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};