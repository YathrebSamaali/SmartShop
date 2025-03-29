<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;

use App\Models\Product;
use App\Models\Contact;



Route::get('/', function () {
    return view('welcome');
});

// Définir la route "home"
Route::get('/home', function () {
    return view('home'); // Remplace "home" par la vue que tu veux afficher
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', action: [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::get('/', function () {
    // Récupérer tous les produits
    $products = Product::all();

    // Retourner la vue avec les produits
    return view('welcome', compact('products'));
});
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// ----------------------------------------------------------------------
// 1. Routes Administrateurs avec Middleware Auth et Admin
// ----------------------------------------------------------------------
Route::prefix('admin')                       // Préfixe 'admin' pour toutes les routes d'administration
    ->name('admin.')                        // Préfixe du nom de la route pour ajouter "admin." au nom de la route
    ->middleware(['auth', 'admin'])         // Middleware pour vérifier si l'utilisateur est authentifié et s'il est administrateur
    ->group(function () {

        // Route pour accéder au tableau de bord de l'admin
        Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Gestion des utilisateurs avec le contrôleur UserController
        Route::resource('users', UserController::class);

        // Gestion des produits avec le contrôleur ProductController
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');  // <-- Cette ligne

        // Gestion des commandes avec le contrôleur OrderController
        Route::resource('orders', OrderController::class);

        // Route pour accéder aux paramètres de l'admin
        Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    });


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

        // ✅ Ajout de la route pour afficher un produit (SHOW)
        Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

        // ✅ Ajout de la route pour exporter les produits (EXPORT)
        Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    });




    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/export/{format}', [UserController::class, 'export'])->name('users.export');
    });

// ----------------------------------------------------------------------
// 2. Routes pour la Connexion et la Déconnexion de l'Administrateur
// ----------------------------------------------------------------------
// Routes Admin
// ----------------------------------------------------------------------


// Route de redirection vers la page de connexion /admin
Route::redirect('/admin', '/admin/login')->name('admin.redirect');

// Groupement des routes admin avec un préfixe 'admin'
Route::prefix('admin')->name('admin.')->group(function () {

    // Page de connexion (GET)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');

    // Traitement du formulaire de connexion (POST)
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');

    // Déconnexion de l'admin (POST)
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // D'autres routes pour l'admin peuvent être ajoutées ici
});

// ----------------------------------------------------------------------
// 3. Route protégée par le Middleware 'auth' pour afficher le Tableau de Bord
// ----------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');
    });
});


require __DIR__.'/auth.php';



