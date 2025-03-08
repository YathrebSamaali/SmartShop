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
                <img src="{{ asset('images/logo.png') }}" alt="SmartShop Logo" class="h-8 inline-block mr-2">
            </a>

            <!-- Authentication Links -->
            <div class="space-x-6">
                @guest
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-300 hover:text-white">Register</a>
                @else
                    <a href="{{ route('home') }}" class="text-gray-300 hover:text-white">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Hero Section with Light Background -->
    <div class="bg-gray-50 min-h-screen flex flex-col justify-center items-center text-center p-10">
        <h1 class="text-5xl font-bold mb-4 text-gray-900">Welcome to SmartShop!</h1>
        <p class="text-xl mb-6 text-gray-700">Your one-stop shop for all your needs.</p>
    </div>

</body>
</html>
