<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <title>Welcome - SmartShop</title>

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-900">

    <!-- Include Header -->
    @include('layouts.header')

    <!-- Hero Section with Background Image and Text/Image Layout -->
    <div class="relative w-full h-screen bg-cover bg-center pt-12" style="background-image: url('{{ asset('images/bg.jpg') }}');">
        <div class="flex h-full items-center justify-between px-10 text-white">
            <!-- Left Part: Title and Paragraph -->
            <div class="w-1/2 pl-24">
                <!-- Elegant Title -->
                <h1 class="text-5xl font-playfair text-6xl font-semibold mb-4 leading-tight" style="font-family: 'Playfair Display', serif; color: #543929;">
                    Discover Timeless Elegance and Luxury
                </h1>
                <!-- Elegant Paragraph -->
                <p class="text-xl mb-6 text-gray-300 leading-relaxed" style="font-family: 'Poppins', sans-serif; color: #1C2942;">
                    Explore a curated collection that blends sophistication and modern style. Experience an exclusive selection of designs to enhance your lifestyle. Redefine elegance with every detail.
                </p>
                <a href="" class="inline-block px-6 py-2 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all">See More</a>
            </div>
        </div>
    </div>

    <div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-semibold text-center mb-8">Our Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($products as $product)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Affichage de l'image -->
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full h-64 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">{{ $product->name }}</h3>
                        <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                        <a href="#" class="inline-block mt-4 text-blue-600">View Details</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


    <!-- Include Footer -->
    @include('layouts.footer')

</body>
</html>
