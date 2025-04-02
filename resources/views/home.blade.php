<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartShop - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-50">
    @include('layouts.header')

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Message de bienvenue conditionnel -->
        @if(session('welcome_message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-8" role="alert">
                <p class="font-bold">Bienvenue !</p>
                <p>{{ session('welcome_message') }}</p>
            </div>
        @endif

        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-[#543929] to-[#3a2a1d] rounded-lg text-black p-8 md:p-12 mb-12" style="margin: 150px;">
            <div class="max-w-2xl">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Welcome to SmartShop</h1>
                @auth
                    <p class="text-lg md:text-xl mb-6">Welcome back, {{ Auth::user()->name }}!</p>
                @else
                <p class="text-lg md:text-xl mb-6">Discover our exclusive collection of high-quality products</p>
                @endauth
                <a href="/products" class="bg-white text-[#543929] px-6 py-3 rounded-lg font-medium hover:bg-gray-100 transition duration-300 inline-block" style=" border: 1px solid black;">Explorer la boutique</a>
            </div>
        </section>

        <!-- ... (le reste de votre contenu existant) ... -->
    </main>

    @include('layouts.footer')
</body>
</html>
