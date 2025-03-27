<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Méthode pour afficher tous les utilisateurs
    public function index()
    {
        // Code pour récupérer et afficher les utilisateurs
    }

    // Méthode pour afficher le formulaire de création d'un utilisateur
    public function create()
    {
        // Code pour afficher le formulaire
    }

    // Méthode pour enregistrer un utilisateur
    public function store(Request $request)
    {
        // Code pour enregistrer un nouvel utilisateur
    }

    // Méthode pour afficher un utilisateur
    public function show($id)
    {
        // Code pour afficher un utilisateur spécifique
    }

    // Méthode pour afficher le formulaire d'édition d'un utilisateur
    public function edit($id)
    {
        // Code pour afficher le formulaire d'édition
    }

    // Méthode pour mettre à jour un utilisateur
    public function update(Request $request, $id)
    {
        // Code pour mettre à jour un utilisateur spécifique
    }

    // Méthode pour supprimer un utilisateur
    public function destroy($id)
    {
        // Code pour supprimer un utilisateur
    }
}
