<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |----------------------------------------------------------------------
    | Register Controller
    |----------------------------------------------------------------------
    |
    | Ce contrôleur gère l'enregistrement des nouveaux utilisateurs, ainsi que
    | leur validation et création. Par défaut, ce contrôleur utilise un trait
    | pour fournir cette fonctionnalité sans nécessiter de code supplémentaire.
    |
    */

    use RegistersUsers;

    /**
     * Où rediriger les utilisateurs après l'enregistrement.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crée une nouvelle instance de contrôleur.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Obtenir un validateur pour une demande d'enregistrement entrante.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],      // Validation de l'adresse
            'postal_code' => ['required', 'string', 'max:20'],    // Validation du code postal
            'phone_number' => ['required', 'string', 'max:20'],   // Validation du numéro de téléphone
        ]);
    }

    /**
     * Créer une nouvelle instance de l'utilisateur après un enregistrement valide.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],           // Ajout de l'adresse
            'postal_code' => $data['postal_code'],   // Ajout du code postal
            'phone_number' => $data['phone_number'], // Ajout du numéro de téléphone
        ]);
    }
}
