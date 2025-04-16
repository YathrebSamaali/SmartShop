<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\UserProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Models\Product;
use App\Models\Contact;
use App\Http\Controllers\Admin\AdminMessageController;


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

// Routes utilisateur
// Routes utilisateur
Route::get('/', [UserProductController::class, 'welcome'])->name('home');
Route::get('/products', [UserProductController::class, 'index'])->name('products');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/products/{id}/quickview', function($id) {
    $product = \App\Models\Product::findOrFail($id);

    return response()->json([
        'id' => $product->id,
        'name' => $product->name,
        'description' => $product->description,
        'price' => number_format($product->price, 2),
        'stock' => $product->stock,
        'image' => $product->image ? asset('storage/'.$product->image) : asset('images/placeholder.jpg'),
        'category' => $product->category
    ]);
});
Route::get('/cart', function () {
    return view('cart'); // Assurez-vous d'avoir une vue cart.blade.php
})->name('cart');

// Ou si vous avez un contrôleur :
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');



Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');


Route::get('/products/{product}', [UserProductController::class, 'show'])->name('products.show');
Route::match(['put', 'patch'], '/cart/{item}', [CartController::class, 'update'])
     ->name('cart.update');


Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');

Route::get('/checkout/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
// routes/web.php

// ----------------------------------------------------------------------
// 1. Routes Administrateurs avec Middleware Auth et Admin
// ----------------------------------------------------------------------
Route::prefix('admin')                       // Préfixe 'admin' pour toutes les routes d'administration
    ->name('admin.')                        // Préfixe du nom de la route pour ajouter "admin." au nom de la route
    ->middleware(['auth', 'admin'])         // Middleware pour vérifier si l'utilisateur est authentifié et s'il est administrateur
    ->group(function () {

        // Route pour accéder au tableau de bord de l'admin
        Route::get('admindashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');


        // Gestion des commandes avec le contrôleur OrderController
        Route::resource('orders', OrderController::class);

        // Route pour accéder aux paramètres de l'admin
        Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    });


    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // ✅ Ajout de la route pour afficher un produit (SHOW)
        Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

        // ✅ Ajout de la route pour exporter les produits (EXPORT)
        Route::get('/products/export/{format}', [ProductController::class, 'export'])->name('products.export');
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



    Route::prefix('admin')->name('admin.')->group(function () {
        // Routes pour les commandes (orders)
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::get('/orders/export/{format}', [OrderController::class, 'export'])->name('orders.export');
        Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::get('/orders/{order}/invoice', [OrderController::class, 'invoice'])->name('invoice');

    });




// Page de contact
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'submit'])->name('contact.submit');
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::delete('/messages/{id}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');
    Route::get('/messages/{id}', [AdminMessageController::class, 'show'])->name('messages.show');
    
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

Route::prefix('admin')->name('admin.')->group(function () {
    // Authentification admin


    // Routes protégées admin
    Route::middleware(['auth:admin'])->group(function () {
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/admindashboard', function () {
            return view('admin.admindashboard');
        })->name('admindashboard');

        // Vos autres routes admin...
    });
});
require __DIR__.'/auth.php';


