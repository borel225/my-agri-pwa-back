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
        Schema::create('distribution_cartes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producteur_id')->constrained('producteurs');
            $table->foreignId('mission_suivi_id')->constrained('mission_suivis');
            $table->date('date_distribution');
            $table->string('lieu_distribution', 150)->nullable();
            $table->string('telephone_kyc', 30)->nullable();
            $table->boolean('kyc_synchronise')->nullable();
            $table->boolean('carte_activee')->nullable();
            $table->string('motif_non_activation', 200)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribution_cartes');
    }
};
