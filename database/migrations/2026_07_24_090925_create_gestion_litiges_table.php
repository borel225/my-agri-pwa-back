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
        Schema::create('gestion_litiges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mission_suivi_id')->constrained('mission_suivis');
            $table->foreignId('parcelle_id')->constrained('parcelles');
            $table->string('motif_changement_propriete', 100)->nullable();
            $table->string('qualite_autorite_villageoise', 100)->nullable();
            $table->string('nom_autorite_villageoise', 100)->nullable();
            $table->boolean('visa_autorite_villageoise')->nullable();
            $table->date('date_collecte');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gestion_litiges');
    }
};
