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
        Schema::create('ayant_droit_parcelles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ayant_droit_id')->constrained('ayant_droits');

            $table->foreignId('parcelle_id')->constrained('parcelles');

            $table->decimal('superficie_attribuee_ha',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayant_droit_parcelles');
    }
};
