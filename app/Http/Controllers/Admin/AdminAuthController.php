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
        if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {
            return redirect()->route('admin.admindashboard');
        }

        return back()->withErrors(['email' => 'Identifiants incorrects']);
    }

    // Déconnexion de l'admin
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
