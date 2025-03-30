<!-- resources/views/layouts/navigation.blade.php -->
<nav class="bg-gray-900 p-4 shadow-md fixed w-full top-0 left-0 z-50">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ url('/') }}" class="text-white text-lg font-semibold">SmartShop</a>

        <div class="flex items-center space-x-4">
            <!-- Home Link -->
            <a href="{{ route('home') }}" class="text-white">Home</a>

            <!-- Conditionally show the profile link if the user is authenticated -->
            @auth
                <a href="{{ route('profile.edit') }}" class="text-white">Profile</a>
            @endauth

            <!-- Display login/register links if the user is not authenticated -->
            @guest
                <a href="{{ route('login') }}" class="text-white">Login</a>
                <a href="{{ route('register') }}" class="text-white">Register</a>
            @endguest
        </div>
    </div>
</nav>
