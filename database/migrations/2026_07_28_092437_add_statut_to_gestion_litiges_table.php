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
        Schema::table('gestion_litiges', function (Blueprint $table) {
            //
             $table->string('statut_litige',30)->default('OUVERT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gestion_litiges', function (Blueprint $table) {
            //
             $table->dropColumn('statut_litige');
        });
    }
};
