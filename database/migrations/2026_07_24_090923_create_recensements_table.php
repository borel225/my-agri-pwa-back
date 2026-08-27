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
        Schema::create('recensements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producteur_id')->constrained('producteurs');
            $table->foreignId('mission_suivi_id')->constrained('mission_suivis');
            $table->date('date_recensement');
            $table->string('observation_recensement', 200)->nullable();
            $table->integer('parcelle_declaree')->nullable();
            $table->integer('nb_parcelle_levee')->nullable();
            $table->integer('parcelles_restant_levee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recensements');
    }
};
