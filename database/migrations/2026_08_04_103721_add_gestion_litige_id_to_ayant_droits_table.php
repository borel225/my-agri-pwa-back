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
        Schema::table('ayant_droits', function (Blueprint $table) {
            //
            $table->foreignId('gestion_litige_id')->after('id')
            ->constrained('gestion_litiges')
            ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ayant_droits', function (Blueprint $table) {
            //
            $table->dropForeign(['gestion_litige_id']);
            $table->dropColumn('gestion_litige_id');
        });
    }
};
