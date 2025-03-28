<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf;
class UserController extends Controller
{
    // Afficher tous les utilisateurs
    public function index()
    {
        $users = User::paginate(3);  // Récupérer tous les utilisateurs
        return view('admin.users.index', compact('users'));
    }

    // Afficher le formulaire pour créer un nouvel utilisateur
    public function create()
    {
        return view('admin.users.create');
    }

    // Enregistrer un nouvel utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',  // Le champ password_confirmation est nécessaire
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);  // Hashage du mot de passe
        $user->last_login = now();  // Ajouter la valeur de last_login lors de la création de l'utilisateur
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès');
    }

    // Afficher le formulaire pour éditer un utilisateur existant
    public function edit($id)
    {
        $user = User::findOrFail($id);  // Récupérer l'utilisateur par son ID
        return view('admin.users.edit', compact('user'));
    }

    // Mettre à jour un utilisateur existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id, // Exclure l'utilisateur actuel
            'password' => 'nullable|min:8|confirmed',  // Le champ password_confirmation est nécessaire
        ]);

        $user = User::findOrFail($id);  // Récupérer l'utilisateur par son ID
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = bcrypt($request->password);  // Si un mot de passe est fourni, le mettre à jour
        }
        // Si vous voulez mettre à jour le champ last_login à chaque mise à jour de l'utilisateur
        $user->last_login = now();  // Mettre à jour le champ last_login
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function export($format)
    {
        switch ($format) {
            case 'csv':
                return Excel::download(new UsersExport, 'users.csv');
            case 'excel':
                return Excel::download(new UsersExport, 'users.xlsx');
            case 'pdf':
                $users = User::all();
                $pdf = PDF::loadView('admin.users.export_pdf', compact('users'));
                return $pdf->download('users.pdf');
            default:
                abort(404, 'Format non supporté');
        }
    }
    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);  // Récupérer l'utilisateur par son ID
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
