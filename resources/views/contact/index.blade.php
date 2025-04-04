<!-- resources/views/contact.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - SmartShop</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Leaflet CSS for maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding-top: 80px;
            background-color: #f8f8f8;
        }
        #map {
            height: 350px;
            width: 100%;
            border-radius: 0.5rem;
            z-index: 0;
            filter: grayscale(100%);
            transition: all 0.3s ease;
        }
        #map:hover {
            filter: grayscale(70%);
        }
        .contact-info-card {
            transition: all 0.3s ease;
            border: 1px solid #e5e5e5;
            height: 100%;
        }
        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-color: #d1d1d1;
        }
        .icon-container {
            background-color: #f0f0f0;
            transition: all 0.3s ease;
        }
        .contact-info-card:hover .icon-container {
            background-color: #e0e0e0;
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(0,0,0,0.05);
        }
        .social-icon {
            transition: all 0.3s ease;
        }
        .social-icon:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <!-- Inclusion du header -->
    @include('layouts.header')

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-12">
        <!-- Page Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">Get In Touch</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">We're here to help and answer any questions you might have. We look forward to hearing from you.</p>
        </div>

        <!-- Contact Cards - Moved to top -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Address Card -->
            <div class="contact-info-card bg-white p-8 rounded-lg flex flex-col">
                <div class="flex items-center mb-5">
                    <div class="icon-container p-4 rounded-full mr-5">
                        <i class="fas fa-map-marker-alt text-gray-700 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Our Location</h3>
                </div>
                <div class="flex-grow">
                    <p class="text-gray-600">123 Shop Street</p>
                    <p class="text-gray-600">Commerce City, CA 90210</p>
                </div>
            </div>

            <!-- Phone Card -->
            <div class="contact-info-card bg-white p-8 rounded-lg flex flex-col">
                <div class="flex items-center mb-5">
                    <div class="icon-container p-4 rounded-full mr-5">
                        <i class="fas fa-phone-alt text-gray-700 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Phone Number</h3>
                </div>
                <div class="flex-grow">
                    <p class="text-gray-600">+1 (555) 123-4567</p>
                    <p class="text-gray-600 mt-2">Mon-Fri: 9am-6pm PST</p>
                </div>
            </div>

            <!-- Email Card -->
            <div class="contact-info-card bg-white p-8 rounded-lg flex flex-col">
                <div class="flex items-center mb-5">
                    <div class="icon-container p-4 rounded-full mr-5">
                        <i class="fas fa-envelope text-gray-700 text-xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Email Address</h3>
                </div>
                <div class="flex-grow">
                    <p class="text-gray-600">contact@smartshop.com</p>
                    <p class="text-gray-600 mt-2">support@smartshop.com</p>
                </div>
            </div>
        </div>

        <!-- Map and Contact Form Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Map Section -->
            <div class="order-2 lg:order-1">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Our Store Location</h2>
                    <div id="map"></div>
                    <div class="mt-4 flex items-center text-gray-600">
                        <i class="fas fa-clock mr-3 text-gray-500"></i>
                        <span>Open Monday to Friday: 9:00 AM - 6:00 PM</span>
                    </div>
                    <div class="mt-3 flex items-center text-gray-600">
                        <i class="fas fa-car mr-3 text-gray-500"></i>
                        <span>Free parking available in front of the store</span>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="order-1 lg:order-2">
                <div class="bg-white p-8 rounded-lg shadow-sm border border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
                    <form action="#" method="POST" class="space-y-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="name" name="name"
                                   class="form-input w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition duration-300"
                                   placeholder="Your name" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" id="email" name="email"
                                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition duration-300"
                                       placeholder="your.email@example.com" required>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="tel" id="phone" name="phone"
                                       class="form-input w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition duration-300"
                                       placeholder="+1 (555) 123-4567">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <select id="subject" name="subject"
                                    class="form-input w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition duration-300">
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="order">Order Question</option>
                                <option value="return">Return/Exchange</option>
                                <option value="feedback">Feedback</option>
                            </select>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your Message *</label>
                            <textarea id="message" name="message" rows="5"
                                      class="form-input w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-400 focus:border-gray-400 transition duration-300"
                                      placeholder="How can we help you?" required></textarea>
                        </div>

                        <div class="pt-2">
                            <button type="submit"
                                    class="w-full bg-black text-white px-6 py-4 rounded-md hover:bg-gray-800 transition duration-300 font-medium shadow-sm hover:shadow-md">
                                <i class="fas fa-paper-plane mr-2"></i> Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Follow Us</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-10">Stay connected with us on social media for the latest updates and promotions.</p>

            <div class="flex justify-center space-x-8">
                <a href="#" class="social-icon bg-gray-100 p-4 rounded-full hover:bg-gray-200 transition duration-300 text-gray-700">
                    <i class="fab fa-facebook-f text-xl"></i>
                </a>
                <a href="#" class="social-icon bg-gray-100 p-4 rounded-full hover:bg-gray-200 transition duration-300 text-gray-700">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <a href="#" class="social-icon bg-gray-100 p-4 rounded-full hover:bg-gray-200 transition duration-300 text-gray-700">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
                <a href="#" class="social-icon bg-gray-100 p-4 rounded-full hover:bg-gray-200 transition duration-300 text-gray-700">
                    <i class="fab fa-youtube text-xl"></i>
                </a>
                <a href="#" class="social-icon bg-gray-100 p-4 rounded-full hover:bg-gray-200 transition duration-300 text-gray-700">
                    <i class="fab fa-pinterest-p text-xl"></i>
                </a>
            </div>
        </div>
    </main>

    <!-- Inclusion du footer -->
    @include('layouts.footer')

    <!-- Leaflet JS for maps -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialize the map
        document.addEventListener('DOMContentLoaded', function() {
            const map = L.map('map').setView([34.0522, -118.2437], 16); // More zoomed in

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Custom icon
            const storeIcon = L.divIcon({
                className: 'store-icon',
                html: '<i class="fas fa-store text-2xl text-gray-800"></i>',
                iconSize: [30, 30],
                iconAnchor: [15, 30]
            });

            // Add a marker with custom icon
            L.marker([34.0522, -118.2437], {icon: storeIcon}).addTo(map)
                .bindPopup('<div class="font-semibold">SmartShop Headquarters</div><div>123 Shop Street, Commerce City</div>')
                .openPopup();

            // Mobile menu toggle
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                menu.classList.toggle('hidden');
            });
        });
    </script>
</body>
</html>
