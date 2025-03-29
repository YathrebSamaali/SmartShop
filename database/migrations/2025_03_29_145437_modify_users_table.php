<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // Ajouter les nouveaux champs
        $table->string('address')->nullable();
        $table->string('postal_code')->nullable();
        $table->string('phone_number')->nullable();

        // Supprimer la colonne 'role'
        $table->dropColumn('role');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        // Annuler les ajouts
        $table->dropColumn(['address', 'postal_code', 'phone_number']);

        // Ajouter de nouveau la colonne 'role'
        $table->string('role')->nullable();
    });
}

};
