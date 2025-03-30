<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Utilisation correcte du modèle User
use Illuminate\Support\Facades\Hash; // Utilisation correcte de Hash

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'email' => 'admin@smartshop.com',
            'password' => Hash::make('adminpassword'), // Le mot de passe hashé
            // 'is_admin' => true, // Si tu utilises 'is_admin'
        ]);
    }
}
