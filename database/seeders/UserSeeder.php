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
            'role' => 'admin', // Ajoute un rôle si nécessaire
            'last_login' => now(), // Ajout de la date et l'heure actuelle
        ]);

        // Création d'un utilisateur normal
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'last_login' => now(), // Ajout de la date et l'heure actuelle
        ]);

        // Génération de 10 utilisateurs aléatoires avec un Factory
        User::factory(10)->create()->each(function ($user) {
            $user->update(['last_login' => now()]); // Mise à jour du champ last_login pour chaque utilisateur créé
        });
    }
}
