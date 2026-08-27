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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('matricule')->unique()->after('id');
            $table->string('nom')->after('matricule');
            $table->string('prenoms')->after('nom');
            $table->string('telephone')->nullable()->after('email');
            $table->string('fonction')->nullable()->after('telephone');
            $table->boolean('actif')->default(true)->after('password');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn([
                'matricule',
                'nom',
                'prenoms',
                'telephone',
                'fonction',
                'actif',
            ]);
        });
    }
};
