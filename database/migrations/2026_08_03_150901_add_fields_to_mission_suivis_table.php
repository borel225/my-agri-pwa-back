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
        Schema::table('mission_suivis', function (Blueprint $table) {
            //
                $table->string('code_mission',30)->nullable()->after('id');

                $table->date('date_mission')->nullable()->after('localite_id');

                $table->string('statut',30)->default('Planifiée')->after('observation');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mission_suivis', function (Blueprint $table) {
            //
        });
    }
};
