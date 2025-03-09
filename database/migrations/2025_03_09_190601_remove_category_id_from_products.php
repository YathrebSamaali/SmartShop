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
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('category_id'); // Supprime la colonne 'category_id'
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->integer('category_id')->nullable(); // Recrée la colonne 'category_id' si la migration est annulée
    });
}

};
