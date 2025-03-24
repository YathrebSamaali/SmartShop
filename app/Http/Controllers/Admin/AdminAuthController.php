<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Afficher le formulaire de connexion
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    // Traiter la soumission du formulaire de connexion
    public function login(Request $request)
    {
        // Validation des entrées
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Vérification des informations d'authentification
        $admin = Admin::where('email', $request->email)->first();

        // Si l'administrateur existe et que le mot de passe est correct
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Authentifier l'administrateur
            Auth::login($admin);
            return redirect()->route('admin.dashboard');
        }

        // Si les informations sont incorrectes
        return back()->withErrors([
            'email' => 'Les informations de connexion sont incorrectes.',
        ])->withInput();
    }

    // Déconnexion de l'admin
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
