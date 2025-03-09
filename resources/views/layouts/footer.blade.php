<!-- resources/views/layouts/footer.blade.php -->
<footer class="bg-gray-900 text-white py-12 px-6 sm:px-12 lg:px-24">
    <div class="container mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
        <!-- Section 1: Logo and Description -->
        <div>
            <img src="{{ asset('images/smartshop_logo.png') }}" alt="SmartShop Logo" class="h-12 mb-4">
            <p class="text-gray-300">SmartShop is your go-to online store for the latest trends in fashion. Discover stylish pieces and elevate your wardrobe today.</p>
        </div>

        <!-- Section 2: Useful Links -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Useful Links</h3>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-gray-300">Home</a></li>
                <li><a href="#" class="hover:text-gray-300">Products</a></li>
                <li><a href="#" class="hover:text-gray-300">Contact</a></li>
                <li><a href="#" class="hover:text-gray-300">Privacy Policy</a></li>
                <li><a href="#" class="hover:text-gray-300">Terms & Conditions</a></li>
            </ul>
        </div>

        <!-- Section 3: Newsletter -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
            <p class="text-gray-300 mb-4">Subscribe to our newsletter for exclusive offers and updates.</p>
            <form action="#" method="POST">
                <input type="email" name="email" placeholder="Enter your email" class="p-2 rounded-l-md border-none w-3/4 mb-4" required>
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r-md hover:bg-gray-700 focus:outline-none">
                    Subscribe
                </button>
            </form>
        </div>

        <!-- Section 4: Follow Us -->
        <div>
            <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
            <div class="space-x-6">
                <a href="#" class="text-gray-300 hover:text-gray-400"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#" class="text-gray-300 hover:text-gray-400"><i class="fab fa-instagram"></i> Instagram</a>
                <a href="#" class="text-gray-300 hover:text-gray-400"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#" class="text-gray-300 hover:text-gray-400"><i class="fab fa-youtube"></i> YouTube</a>
            </div>
        </div>
    </div>

    <!-- Bottom Copyright -->
    <div class="bg-gray-800 py-4 mt-12">
        <div class="container mx-auto text-center">
            <p class="text-gray-400">&copy; 2025 SmartShop. All rights reserved.</p>
        </div>
    </div>
</footer>
