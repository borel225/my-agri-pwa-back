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
        Schema::create('gestion_outils', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operateur_id')->constrained('operateurs');
            $table->foreignId('mission_suivi_id')->constrained('mission_suivis');
            $table->integer('nombre_delegues_magasiniers_codifies')->nullable();
            $table->integer('tpe_demande')->nullable();
            $table->integer('tpe_recu')->nullable();
            $table->integer('tpe_fonctionnel')->nullable();
            $table->integer('tpe_non_fonctionnel')->nullable();
            $table->integer('tpe_egare')->nullable();
            $table->integer('scelles_demande')->nullable();
            $table->integer('scelles_recu')->nullable();
            $table->integer('scelles_projection')->nullable();
            $table->integer('sacherie_demande')->nullable();
            $table->integer('sacherie_recu')->nullable();
            $table->integer('sacherie_projection')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestion_outils');
    }
};
