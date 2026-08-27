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
        Schema::create('parcelles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producteur_id')->constrained('producteurs');
            $table->string('code_parcelle', 30)->unique();
            $table->string('type_parcelle', 20);
            $table->decimal('superficie_ha', 10, 2)->nullable();
            $table->foreignId('localite_id')->constrained('localites');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parcelles');
    }
};
