<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Mise à jour de la validation pour inclure les nouveaux champs
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' => ['required', 'string', 'max:255'],        // Ajout de l'adresse
            'postal_code' => ['required', 'string', 'max:20'],      // Ajout du code postal
            'phone_number' => ['required', 'string', 'max:20'],     // Ajout du numéro de téléphone
        ]);

        // Création d'un utilisateur avec les nouveaux champs
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'address' => $request->address,                      // Ajout de l'adresse
            'postal_code' => $request->postal_code,              // Ajout du code postal
            'phone_number' => $request->phone_number,            // Ajout du numéro de téléphone
        ]);

        // Déclenchement de l'événement "Registered"
        event(new Registered($user));

        // Connexion automatique de l'utilisateur
        Auth::login($user);

        // Redirection vers le tableau de bord ou une autre page après l'inscription
        return redirect(route('dashboard', absolute: false));
    }
}
