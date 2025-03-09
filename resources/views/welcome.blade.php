<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Welcome - SmartShop</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-900">

    <!-- Navbar -->
    <nav class="bg-gray-900 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-white text-xl font-semibold">
                <img src="{{ asset('') }}" alt="SmartShop Logo" class="h-8 inline-block mr-2">

            </a>

            <!-- Authentication Links -->
            <div class="space-x-6">
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a>
                    <a href="{{ route('register') }}" class="text-white hover:text-gray-300">Register</a>
                @else
                    <a href="{{ route('home') }}" class="text-white hover:text-gray-300">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="text-white hover:text-gray-300">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Hero Section with Background Image and Text/Image Layout -->
    <div class="relative w-full h-screen bg-cover bg-center pt-12" style="background-image: url('{{ asset('images/slider-bg.jpg') }}');">
        <div class="flex h-full items-center justify-between px-10 text-white">
            <!-- Left Part: Title and Paragraph -->
            <div class="w-1/2">
                <h1 class="text-5xl font-bold mb-4">Welcome to SmartShop!</h1>
                <p class="text-xl mb-6">Your one-stop shop for all your needs. Discover amazing products for all occasions, including fashion, gadgets, and more!</p>
            </div>
        </div>
    </div>

</body>
</html>
