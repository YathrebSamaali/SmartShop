<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">    <title>@yield('title', 'Mon E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    @stack('styles')

</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-xl font-bold">Mon E-Commerce</a>

            <nav class="flex items-center space-x-6">
                <a href="/products" class="hover:text-blue-600">Boutique</a>

                @auth
                    <div class="relative">
                        <a href="{{ route('cart') }}" class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            @inject('cartService', 'App\Services\CartService')
                            <span class="cart-count absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                {{ $cartService->getCount(auth()->id()) }}
                            </span>
                        </a>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-blue-600">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-blue-600">Connexion</a>
                    <a href="{{ route('register') }}" class="hover:text-blue-600">Inscription</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-8">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>

   

    @stack('scripts')
</body>
</html>
