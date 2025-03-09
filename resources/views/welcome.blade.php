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
                <img src="{{ asset('images/samartshop_logo.png') }}" alt="SmartShop Logo" class="h-12 inline-block mr-2">
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
<div class="relative w-full h-screen bg-cover bg-center pt-12" style="background-image: url('{{ asset('images/test4.jpg') }}');">
    <div class="flex h-full items-center justify-between px-10 text-white">
        <!-- Left Part: Title and Paragraph -->
        <div class="w-1/2 pl-24">
            <h1 class="text-5xl font-bold mb-4" style="color: #543925;">Elevate Your Style with SmartShop</h1>
            <p class="text-xl mb-6 text-gray-300">Discover the latest trends at SmartShop, where fashion meets comfort. From casual chic to elegant evening wear, we offer a wide range of stylish pieces that make you stand out. Shop with us and transform your wardrobe today!</p>
            <a href="" class="inline-block px-6 py-2 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all">See More</a>
        </div>
    </div>
</div>


</body>
</html>
