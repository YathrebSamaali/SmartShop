<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Appel du seeder pour l'utilisateur admin
        $this->call(AdminUserSeeder::class);

        // Si tu veux réinitialiser certaines tables avant de les remplir :
        // DB::table('users')->truncate();
    }
}
