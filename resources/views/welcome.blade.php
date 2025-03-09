<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome - SmartShop</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">


    </style>
</head>
<body class="bg-white text-gray-900">

    <!-- Header Section -->
    @include('layouts.header')

    <!-- Hero Section -->
    <div class="relative w-full h-screen bg-cover bg-center pt-12" style="background-image: url('{{ asset('images/bg.jpg') }}');">
        <div class="flex h-full items-center justify-between px-10 text-white">
            <div class="w-1/2 pl-24">
                <h1 class="text-6xl font-semibold mb-4 leading-tight" style="font-family: 'Playfair Display', serif; color: #543929;">
                    Discover Timeless Elegance and Luxury
                </h1>
                <p class="text-xl mb-6 leading-relaxed" style="font-family: 'Poppins', sans-serif; color: #1C2942;">
                    Explore a curated collection that blends sophistication and modern style. Experience an exclusive selection of designs to enhance your lifestyle.
                </p>
                <a href="#products" class="inline-block px-6 py-2 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-all">
                    See More
                </a>
            </div>
        </div>
    </div>
<!-- Products Section -->
<section id="products" class="py-12 bg-gray-100">
    <h2 class="text-5xl font-bold text-center mb-8" style="font-family: 'Playfair Display', serif; color: #543929;">
        Our Products
    </h2>

    <!-- Category Filter Buttons -->
    <div class="text-center mb-8">
    <div class="space-x-4">
        <!-- All Products Button: Maintient le fond et les effets de survol -->
        <button class="category-btn bg-gray-800 text-white px-6 py-2 rounded-lg" data-category="all">
            All Products
        </button>

        <!-- Men Button: Ajoute une bordure noire sans effet de survol, texte en noir -->
        <button class="category-btn border-2 border-black text-black px-6 py-2 rounded-lg" data-category="Men">
            Men
        </button>

        <!-- Women Button: Ajoute une bordure noire sans effet de survol, texte en noir -->
        <button class="category-btn border-2 border-black text-black px-6 py-2 rounded-lg" data-category="Women">
            Women
        </button>

        <!-- Shoes Button: Ajoute une bordure noire sans effet de survol, texte en noir -->
        <button class="category-btn border-2 border-black text-black px-6 py-2 rounded-lg" data-category="Shoes">
            Shoes
        </button>
    </div>
</div>


    <!-- Products Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 px-36" id="product-grid">
        @foreach ($products as $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-2xl product-item" data-category="{{ $product->category }}">
                <div class="relative group">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-96 object-cover transition-transform duration-300 group-hover:scale-110">
                    <span class="absolute top-4 left-4 bg-gray-900 text-white text-sm font-semibold px-3 py-1 rounded-full">
                        {{ number_format($product->price, 2) }} DT
                    </span>
                    <a href="{{ route('product.show', $product->id) }}" class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="bg-white text-[#543929] font-semibold py-2 px-4 rounded-lg shadow-md hover:bg-[#543929] hover:text-black transition">
                            Quick View
                        </span>
                    </a>
                </div>
                <div class="p-4 flex flex-col">
                    <h3 class="text-xl font-semibold text-gray-900">{{ $product->name }}</h3>
                    <p class="text-gray-600 mt-2 line-clamp-2">{{ $product->description }}</p>
                </div>
            </div>
        @endforeach
    </div>
</section>

<!-- JavaScript for Category Filter -->
<script>
    // Sélectionner tous les boutons de catégorie
    const categoryButtons = document.querySelectorAll('.category-btn');
    const productItems = document.querySelectorAll('.product-item');

    categoryButtons.forEach(button => {
        button.addEventListener('click', function() {
            const category = this.getAttribute('data-category'); // Récupérer la catégorie du bouton cliqué

            // Afficher ou masquer les produits selon la catégorie
            productItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category').toLowerCase();

                if (category === 'all' || itemCategory === category.toLowerCase()) {
                    item.style.display = 'block'; // Afficher le produit
                } else {
                    item.style.display = 'none'; // Masquer le produit
                }
            });

            // Mettre à jour l'apparence des boutons (par exemple, ajouter une classe active)
            categoryButtons.forEach(btn => btn.classList.remove('bg-gray-100', 'font-semibold'));
            this.classList.add('bg-gray-100', 'font-semibold');
        });
    });
</script>

<section id="new-collection" class="py-12 bg-gray-100">
    <!-- Section Collection -->
    <div class="flex justify-center gap-4">
        <img src="images/collection1.jpg" alt="New Collection 1" class="w-1/5 h-96 object-cover">
        <img src="images/collection2.png" alt="New Collection 2" class="w-1/5 h-96 object-cover">
        <img src="images/collection3.png" alt="New Collection 3" class="w-1/5 h-96 object-cover">
        <img src="images/collection4.png" alt="New Collection 4" class="w-1/5 h-96 object-cover">
        <img src="images/collection5.png" alt="New Collection 5" class="w-1/5 h-96 object-cover">
        <!-- Vous pouvez ajouter jusqu'à 10 images selon vos besoins -->
    </div>
</section>

<section class="services py-12 bg-gray-100">
    <div class="container mx-auto px-6" style="padding-left: 150px; padding-right: 150px;">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Free Shipping -->
            <div class="service-item flex items-center justify-center bg-white p-6 rounded-lg shadow-lg">
                <div class="text-center">
                    <!-- Icône simple (truck) -->
                    <span class="text-3xl mb-3">&#x1F69A;</span> <!-- Icône Unicode camion -->
                    <h3 class="text-lg font-semibold">Free Shipping</h3>
                    <p class="text-sm text-gray-500 mt-2">Suffered Alteration in Some Form</p>
                </div>
            </div>
            
            <!-- Cash on Delivery -->
            <div class="service-item flex items-center justify-center bg-white p-6 rounded-lg shadow-lg">
                <div class="text-center">
                    <!-- Icône simple (money) -->
                    <span class="text-3xl mb-3">&#x1F4B8;</span> <!-- Icône Unicode argent -->
                    <h3 class="text-lg font-semibold">Cash on Delivery</h3>
                    <p class="text-sm text-gray-500 mt-2">The Internet Tend To Repeat</p>
                </div>
            </div>
            
            <!-- 45 Days Return -->
            <div class="service-item flex items-center justify-center bg-white p-6 rounded-lg shadow-lg">
                <div class="text-center">
                    <!-- Icône simple (retour) -->
                    <span class="text-3xl mb-3">&#x21BB;</span> <!-- Icône Unicode retour -->
                    <h3 class="text-lg font-semibold">45 Days Return</h3>
                    <p class="text-sm text-gray-500 mt-2">Making it Look Like Readable</p>
                </div>
            </div>
            
            <!-- Opening All Week -->
            <div class="service-item flex items-center justify-center bg-white p-6 rounded-lg shadow-lg">
                <div class="text-center">
                    <!-- Icône simple (clock) -->
                    <span class="text-3xl mb-3">&#x1F551;</span> <!-- Icône Unicode horloge -->
                    <h3 class="text-lg font-semibold">Opening All Week</h3>
                    <p class="text-sm text-gray-500 mt-2">8AM - 09PM</p>
                </div>
            </div>

        </div>
    </div>
</section>

    <!-- Footer Section -->
    @include('layouts.footer')

</body>
</html>
