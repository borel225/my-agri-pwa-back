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
        Schema::create('suivi_commercialisations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operateur_id')->constrained('operateurs');
            $table->foreignId('mission_suivi_id')->constrained('mission_suivis');
            $table->date('date_passage');
            $table->decimal('volumes_physiques', 14, 2)->nullable();
            $table->decimal('volumes_setbc', 14, 2)->nullable();
            $table->integer('connaissement_emis')->nullable();
            $table->integer('connaissement_receptionne')->nullable();
            $table->integer('connaissement_refoule')->nullable();
            $table->integer('nb_sacs_sans_scelles')->nullable();
            $table->text('motif_sacs_sans_scelles')->nullable();
            $table->integer('nbre_produ_preenregistres')->nullable();
            $table->string('motif_enquete', 200)->nullable();
            $table->text('observation_enquete')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suivi_commercialisations');
    }
};
