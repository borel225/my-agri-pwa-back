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
        Schema::create('suivi_codification_operateurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operateur_id')->constrained('operateurs');
            $table->foreignId('mission_suivi_id')->constrained('mission_suivis');
            $table->boolean('demande_soumise');
            $table->boolean('demande_traitee_dr')->nullable();
            $table->boolean('demande_validee_stpt')->nullable();
            $table->text('observation_codification')->nullable();
            $table->integer('nbre_delegues_sydore')->nullable();
            $table->integer('nbre_delegues_setbc')->nullable();
            $table->integer('nbre_cartes_editees')->nullable();
            $table->integer('nbre_magasin_geolocalise')->nullable();
            $table->text('observation_personnel')->nullable();
            $table->boolean('kyc_soumis')->nullable();
            $table->boolean('kyc_valide')->nullable();
            $table->string('motif_non_conformite', 200)->nullable();
            $table->boolean('operateur_forme_deploye')->nullable();
            $table->text('observation_enrolement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivi_codification_operateurs');
    }
};
