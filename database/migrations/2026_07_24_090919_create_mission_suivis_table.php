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
        Schema::create('mission_suivis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campagne_id')->constrained('campagnes');
            $table->foreignId('agent_id')->constrained('agents');
            $table->foreignId('localite_id')->constrained('localites');
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_suivis');
    }
};
