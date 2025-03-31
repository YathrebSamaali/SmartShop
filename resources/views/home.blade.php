<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon E-Commerce - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50">
@include('layouts.header')

    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold text-[#543929]">MonShop</a>
            </div>

            <nav class="hidden md:flex space-x-8">
                <a href="/" class="text-gray-700 hover:text-[#543929] font-medium">Accueil</a>
                <a href="/products" class="text-gray-700 hover:text-[#543929] font-medium">Boutique</a>
                <a href="/about" class="text-gray-700 hover:text-[#543929] font-medium">À propos</a>
                <a href="/contact" class="text-gray-700 hover:text-[#543929] font-medium">Contact</a>
            </nav>

            <div class="flex items-center space-x-4">
                <a href="/search" class="text-gray-700 hover:text-[#543929]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </a>
                
                <a href="/account" class="text-gray-700 hover:text-[#543929]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-[#543929] to-[#3a2a1d] rounded-lg text-white p-8 md:p-12 mb-12">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Bienvenue sur MonShop</h1>
                <p class="text-lg md:text-xl mb-6">Découvrez notre collection exclusive de produits de qualité</p>
                <a href="/products" class="bg-white text-[#543929] px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition duration-300 inline-block">Explorer la boutique</a>
            </div>
        </section>

        <!-- Featured Products -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Nos produits phares</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                <!-- Product 1 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative">
                        <img src="https://via.placeholder.com/500" alt="Produit 1" class="w-full h-48 object-cover">
                        <button class="quick-view-btn absolute bottom-2 right-2 bg-white text-gray-800 px-3 py-1 rounded-full text-sm font-medium shadow-md hover:bg-gray-100 transition" data-product-id="1">
                            Aperçu rapide
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Produit 1</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-[#543929] font-bold">99.99 DT</span>
                            <button class="text-gray-700 hover:text-[#543929]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative">
                        <img src="https://via.placeholder.com/500" alt="Produit 2" class="w-full h-48 object-cover">
                        <button class="quick-view-btn absolute bottom-2 right-2 bg-white text-gray-800 px-3 py-1 rounded-full text-sm font-medium shadow-md hover:bg-gray-100 transition" data-product-id="2">
                            Aperçu rapide
                        </button>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg mb-1">Produit 2</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-[#543929] font-bold">149.99 DT</span>
                            <span class="text-gray-500 text-sm line-through">179.99 DT</span>
                            <button class="text-gray-700 hover:text-[#543929]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Ajoutez plus de produits ici -->
            </div>
        </section>

        <!-- Call to Action -->
        <section class="bg-gray-100 rounded-lg p-8 text-center mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Inscrivez-vous à notre newsletter</h2>
            <p class="text-gray-600 mb-6">Recevez des offres exclusives et des mises à jour sur nos nouveaux produits</p>
            <form class="max-w-md mx-auto flex">
                <input type="email" placeholder="Votre email" class="flex-grow px-4 py-2 rounded-l-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-[#543929]">
                <button type="submit" class="bg-[#543929] text-white px-6 py-2 rounded-r-lg hover:bg-[#3a2a1d] transition">S'abonner</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-[#3a2a1d] text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">MonShop</h3>
                    <p class="text-gray-300">Votre destination pour des produits de qualité à des prix abordables.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Liens rapides</h4>
                    <ul class="space-y-2">
                        <li><a href="/" class="text-gray-300 hover:text-white">Accueil</a></li>
                        <li><a href="/products" class="text-gray-300 hover:text-white">Boutique</a></li>
                        <li><a href="/about" class="text-gray-300 hover:text-white">À propos</a></li>
                        <li><a href="/contact" class="text-gray-300 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Service client</h4>
                    <ul class="space-y-2">
                        <li><a href="/faq" class="text-gray-300 hover:text-white">FAQ</a></li>
                        <li><a href="/shipping" class="text-gray-300 hover:text-white">Livraison</a></li>
                        <li><a href="/returns" class="text-gray-300 hover:text-white">Retours</a></li>
                        <li><a href="/privacy" class="text-gray-300 hover:text-white">Politique de confidentialité</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contactez-nous</h4>
                    <address class="text-gray-300 not-italic">
                        <p>123 Rue de Commerce</p>
                        <p>Tunis, Tunisie</p>
                        <p class="mt-2">Email: contact@monshop.com</p>
                        <p>Tél: +216 12 345 678</p>
                    </address>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2023 MonShop. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Quick View Modal (le même que précédemment) -->
    <div id="quickViewModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <!-- ... (contenu du modal comme dans votre code précédent) ... -->
    </div>

    <script>
    // Le même script que précédemment pour gérer le quick view
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('quickViewModal');
        const closeModalBtn = document.getElementById('closeModal');
        const quickViewBtns = document.querySelectorAll('.quick-view-btn');
        const addToCartBtn = document.getElementById('addToCartBtn');
        const sizeOptionsContainer = document.getElementById('sizeOptionsContainer');
        const colorOptionsContainer = document.getElementById('colorOptionsContainer');

        // ... (tout le reste du script JavaScript précédent) ...
    });
    </script>
</body>
</html>
