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
        // Ajouter les nouvelles colonnes
        $table->string('postal_code', 10)->nullable();
        $table->string('address', 255)->nullable();
        $table->string('phone_number', 20)->nullable();

        // Supprimer la colonne 'role' si elle existe
        $table->dropColumn('role');
    });
}

public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Supprimer les colonnes ajoutées dans la méthode up()
        $table->dropColumn('postal_code');
        $table->dropColumn('address');
        $table->dropColumn('phone_number');

        // Ajouter la colonne 'role' si la migration est annulée
        $table->string('role')->nullable();
    });
}



};
