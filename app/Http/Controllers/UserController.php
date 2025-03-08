<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Affiche la liste de tous les utilisateurs (accessible par les administrateurs)
    public function index()
    {
        // Récupérer tous les utilisateurs
        $users = User::all();

        // Retourner la vue avec les utilisateurs
        return view('admin.users.index', compact('users'));
    }

    // Affiche le formulaire de modification du profil
    public function edit()
    {
        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Retourner la vue avec les informations de l'utilisateur
        return view('auth.edit', compact('user'));
    }

    // Met à jour les informations du profil de l'utilisateur
    public function update(Request $request)
    {
        // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Récupérer l'utilisateur authentifié
        $user = Auth::user();

        // Mettre à jour les informations de l'utilisateur
        $user->name = $request->name;
        $user->email = $request->email;

        // Si un mot de passe est fourni, le mettre à jour
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Sauvegarder les modifications
        $user->save();

        // Retourner à la page du profil avec un message de succès
        return redirect()->route('profile.edit')->with('status', 'Profil mis à jour avec succès!');
    }

    // Affiche les détails d'un utilisateur spécifique (accessible par les administrateurs)
    public function show($id)
    {
        // Récupérer l'utilisateur par son ID
        $user = User::findOrFail($id);

        // Retourner la vue avec les détails de l'utilisateur
        return view('admin.users.show', compact('user'));
    }

    // Supprimer un utilisateur (accessible par les administrateurs)
    public function destroy($id)
    {
        // Trouver l'utilisateur à supprimer
        $user = User::findOrFail($id);

        // Ne pas permettre la suppression de l'utilisateur administrateur principal
        if ($user->email === 'admin@smartshop.com') {
            return redirect()->route('admin.users.index')->with('error', 'Vous ne pouvez pas supprimer cet utilisateur.');
        }

        // Supprimer l'utilisateur
        $user->delete();

        // Retourner à la liste des utilisateurs avec un message de succès
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
