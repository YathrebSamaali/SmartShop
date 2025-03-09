<!-- resources/views/layouts/header.blade.php -->
<nav class="bg-gray-900 p-4 shadow-md fixed w-full top-0 left-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="text-white text-xl font-semibold">
            <img src="{{ asset('images/smartshop_logo.png') }}" alt="SmartShop Logo" class="h-12 inline-block mr-2">
        </a>

        <!-- Navbar Links -->
        <div class="space-x-6">
            <a href="{{ url('/') }}" class="text-white hover:text-gray-300">Home</a>
            <a href="{{ route('products.index') }}" class="text-white hover:text-gray-300">Products</a>
            <a href="{{ route('contact') }}" class="text-white hover:text-gray-300">Contact</a>

            <!-- Authentication Links -->
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
