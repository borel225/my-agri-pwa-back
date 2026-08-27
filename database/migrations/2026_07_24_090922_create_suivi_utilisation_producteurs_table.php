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
        Schema::create('suivi_utilisation_producteurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producteur_id')->constrained('producteurs');
            $table->foreignId('operateur_id')->nullable()->constrained('operateurs');
            $table->foreignId('mission_suivi_id')->constrained('mission_suivis');
            $table->date('date_passage');
            $table->boolean('statut_recense')->nullable();
            $table->string('etat_carte', 30)->nullable();
            $table->string('type_incident', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivi_utilisation_producteurs');
    }
};
