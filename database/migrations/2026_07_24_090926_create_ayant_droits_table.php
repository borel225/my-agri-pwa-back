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
        Schema::create('ayant_droits', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 50);
            $table->string('prenoms', 100);
            $table->string('contact', 30)->nullable();
            $table->date('date_naissance')->nullable();
            $table->string('type_piece_identite', 50)->nullable();
            $table->string('numero_piece', 20)->nullable();
            $table->foreignId('producteur_id')->nullable()->constrained('producteurs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ayant_droits');
    }
};
