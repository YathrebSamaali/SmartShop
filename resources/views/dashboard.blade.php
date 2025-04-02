<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">

<!-- Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- resources/views/layouts/header.blade.php -->
<nav class="bg-gray-900 p-4 shadow-lg fixed w-full top-0 left-0 z-50">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
        <!-- Logo et partie principale -->
        <div class="flex items-center justify-between w-full md:w-auto">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-white text-xl font-bold flex items-center">
                <img src="{{ asset('images/smartshop_logo.png') }}" alt="SmartShop Logo" class="h-10 mr-3">
            </a>

            <!-- Bouton mobile -->
            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Navbar Links (caché sur mobile par défaut) -->
        <div id="mobile-menu" class="hidden md:flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8 mt-4 md:mt-0 w-full md:w-auto">
            <a href="{{ url('/') }}" class="text-white hover:text-gray-300 transition duration-300 font-medium">Home</a>
            <a href="{{ route('products') }}" class="text-white hover:text-gray-300 transition duration-300 font-medium">Products</a>
            <a href="{{ route('contact') }}" class="text-white hover:text-gray-300 transition duration-300 font-medium">Contact</a>

            <!-- Authentication Links avec icônes -->
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6 pt-4 md:pt-0 border-t md:border-t-0 border-gray-700 w-full md:w-auto text-center">
                @guest
                <a href="{{ route('login') }}" class="text-white hover:text-gray-300 transition duration-300 font-medium">Login</a>
                <a href="{{ route('register') }}" class="bg-white text-gray-900 px-4 py-2 rounded-lg hover:bg-gray-100 transition duration-300 font-medium">Register</a>
                @else
                    <!-- Icône Panier (connecté) -->
                 <!-- Icône Panier (connecté) -->
<!-- Icône Panier -->
<a href="{{ route('cart') }}" class="text-white hover:text-gray-300 transition duration-300 text-xl relative">
    <i class="fas fa-shopping-cart"></i>
    <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
        {{ \App\Http\Controllers\CartController::getCartCount() }}
    </span>
</a>

<!-- Icône Paramètres (Accueil) -->
<a href="{{ route('home') }}" class="text-white hover:text-gray-300 transition duration-300 text-xl ml-4">
    <i class="fas fa-cog"></i>
</a>


                    <!-- Icône Déconnexion -->
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="text-white hover:text-gray-300 transition duration-300 text-xl">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>

<script>
    // Gestion du menu mobile
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
