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
        Schema::create('recensement_parcelle', function (Blueprint $table) {
            $table->id();

            $table->foreignId('recensement_id')->constrained('recensements')->cascadeOnDelete();

            $table->foreignId('parcelle_id')->constrained('parcelles')->cascadeOnDelete();

            $table->decimal('superficie_levee', 10, 2)->nullable();

            $table->boolean('geolocalisee')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recensement_parcelle');
    }
};
