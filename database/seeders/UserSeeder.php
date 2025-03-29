<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'un utilisateur Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Mot de passe sécurisé
            'postal_code' => '12345', // Code postal de l'utilisateur
            'address' => '123 Admin Street', // Adresse de l'utilisateur
            'phone_number' => '0123456789', // Numéro de téléphone
        ]);

        // Création d'un utilisateur normal
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'postal_code' => '54321', // Code postal de l'utilisateur
            'address' => '456 John Street', // Adresse de l'utilisateur
            'phone_number' => '0987654321', // Numéro de téléphone
        ]);

        // Génération de 10 utilisateurs aléatoires avec un Factory
        User::factory(10)->create()->each(function ($user) {
            $user->update([
                'postal_code' => '00000', // Exemple de code postal par défaut
                'address' => 'Random Address', // Exemple d'adresse par défaut
                'phone_number' => '1234567890', // Exemple de numéro de téléphone par défaut
            ]);
        });
    }
}
