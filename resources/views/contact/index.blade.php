<!-- resources/views/contact.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - SmartShop</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Leaflet CSS for maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            padding-top: 80px;
            background-color: #f8fafc;
        }
    
        #map {
            height: 300px;
            width: 100%;
            border-radius: 0.5rem;
            z-index: 0;
            filter: grayscale(20%) sepia(5%) brightness(105%);
            transition: all 0.3s ease;
        }
        #map:hover {
            filter: grayscale(0%) sepia(0%) brightness(100%);
        }
        .contact-info-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(229, 231, 235, 0.8);
            height: 100%;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.03);
        }
        .contact-info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .icon-container {
            background: #f9fafb;
            transition: all 0.3s ease;
        }
        .contact-info-card:hover .icon-container {
            background: #f3f4f6;
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.5);
        }
        .social-icon {
            transition: all 0.2s ease;
            background: white;
        }
        .social-icon:hover {
            transform: translateY(-2px);
        }
        .contact-form-container {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }
        .submit-btn {
            background: #111827;
            transition: all 0.2s ease;
        }
        .submit-btn:hover {
            transform: translateY(-1px);
            background: #1f2937;
        }
        .store-icon {
            filter: drop-shadow(0 1px 2px rgba(0,0,0,0.05));
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, rgba(229,231,235,0) 0%, rgba(229,231,235,1) 50%, rgba(229,231,235,0) 100%);
        }
        .heading-font {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>
<body>
    <!-- Inclusion du header -->
    @include('layouts.header')

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2 block">Contact Us</span>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 heading-font">Get In Touch</h1>
            <div class="divider w-20 h-px mx-auto my-4"></div>
            <p class="text-gray-600 max-w-2xl mx-auto">We're here to help and answer any questions you might have.</p>
        </div>

        <!-- Contact Cards - Avant le formulaire pour contexte -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Address Card -->
            <div class="contact-info-card bg-white p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="icon-container p-3 rounded-lg mr-4">
                        <i class="fas fa-map-marker-alt text-gray-700"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Our Location</h3>
                </div>
                <div>
                    <p class="text-gray-600 text-sm mb-1">123 Shop Street</p>
                    <p class="text-gray-600 text-sm">Commerce City, CA 90210</p>
                    <a href="#" class="inline-block mt-3 text-xs font-medium text-gray-700 hover:text-black transition">
                        <i class="fas fa-directions mr-1"></i> Get Directions
                    </a>
                </div>
            </div>

            <!-- Phone Card -->
            <div class="contact-info-card bg-white p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="icon-container p-3 rounded-lg mr-4">
                        <i class="fas fa-phone-alt text-gray-700"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Phone Number</h3>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">+1 (555) 123-4567</p>
                    <p class="text-gray-600 text-sm mt-1">Mon-Fri: 9am-6pm PST</p>
                    <a href="tel:+15551234567" class="inline-block mt-3 text-xs font-medium text-gray-700 hover:text-black transition">
                        <i class="fas fa-phone-volume mr-1"></i> Call Now
                    </a>
                </div>
            </div>

            <!-- Email Card -->
            <div class="contact-info-card bg-white p-6 rounded-lg">
                <div class="flex items-center mb-4">
                    <div class="icon-container p-3 rounded-lg mr-4">
                        <i class="fas fa-envelope text-gray-700"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Email Address</h3>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">contact@smartshop.com</p>
                    <p class="text-gray-600 text-sm mt-1">support@smartshop.com</p>
                    <a href="mailto:contact@smartshop.com" class="inline-block mt-3 text-xs font-medium text-gray-700 hover:text-black transition">
                        <i class="fas fa-paper-plane mr-1"></i> Email Us
                    </a>
                </div>
            </div>
        </div>

        <!-- Formulaire et carte côte à côte -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
            <!-- Contact Form -->
            <div>
                <div class="contact-form-container p-6 rounded-lg border border-gray-100">
                    <div class="flex items-center mb-5">
                        <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                            <i class="fas fa-envelope-open-text text-gray-600 text-sm"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 heading-font">Send Us a Message</h2>
                    </div>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-xs font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-user text-gray-400 text-sm"></i>
                                </div>
                                <input type="text" id="name" name="name"
                                    class="pl-9 form-input w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-1 focus:ring-gray-300 focus:border-gray-300 transition"
                                    placeholder="Your name" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="email" class="block text-xs font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400 text-sm"></i>
                                    </div>
                                    <input type="email" id="email" name="email"
                                        class="pl-9 form-input w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-1 focus:ring-gray-300 focus:border-gray-300 transition"
                                        placeholder="your.email@example.com" required>
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="block text-xs font-medium text-gray-700 mb-1">Phone</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="fas fa-phone text-gray-400 text-sm"></i>
                                    </div>
                                    <input type="tel" id="phone" name="phone" pattern="\+?[0-9]{1,4}?[-.●]?[0-9]{1,3}[-.●]?[0-9]{3}[-.●]?[0-9]{4}"
                                        class="pl-9 form-input w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-1 focus:ring-gray-300 focus:border-gray-300 transition"
                                        placeholder="+1 (555) 123-4567">
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="subject" class="block text-xs font-medium text-gray-700 mb-1">Subject</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-gray-400 text-sm"></i>
                                </div>
                                <select id="subject" name="subject"
                                        class="pl-9 form-input w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-1 focus:ring-gray-300 focus:border-gray-300 transition appearance-none">
                                    <option value="">Select a subject</option>
                                    <option value="general">General Inquiry</option>
                                    <option value="order">Order Question</option>
                                    <option value="return">Return/Exchange</option>
                                    <option value="feedback">Feedback</option>
                                    <option value="wholesale">Wholesale Inquiry</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="message" class="block text-xs font-medium text-gray-700 mb-1">Your Message <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <div class="absolute top-2 left-2">
                                    <i class="fas fa-comment-dots text-gray-400 text-sm"></i>
                                </div>
                                <textarea id="message" name="message" rows="4"
                                        class="pl-8 form-input w-full px-3 py-2 text-sm border border-gray-200 rounded-md focus:ring-1 focus:ring-gray-300 focus:border-gray-300 transition"
                                        placeholder="How can we help you?" required></textarea>
                            </div>
                        </div>

                        <div class="pt-1">
                            <button type="submit"
                                    class="w-full submit-btn text-white px-4 py-3 rounded-md font-medium text-sm">
                                <i class="fas fa-paper-plane mr-2"></i> Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Map Section -->
            <div>
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 h-full">
                    <div class="flex items-center mb-5">
                        <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                            <i class="fas fa-store text-gray-600 text-sm"></i>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 heading-font">Our Store Location</h2>
                    </div>
                    <div id="map"></div>
                    <div class="mt-5 space-y-2">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-0.5">
                                <i class="fas fa-clock text-gray-400 text-sm mr-2"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-medium text-gray-700">Opening Hours</h4>
                                <p class="text-xs text-gray-600">Monday to Friday: 9:00 AM - 6:00 PM</p>
                                <p class="text-xs text-gray-600">Saturday: 10:00 AM - 4:00 PM</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-0.5">
                                <i class="fas fa-car text-gray-400 text-sm mr-2"></i>
                            </div>
                            <div>
                                <h4 class="text-xs font-medium text-gray-700">Parking Information</h4>
                                <p class="text-xs text-gray-600">Free parking available in front of the store</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Social Media Section -->
        <div class="text-center mb-8">
            <span class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2 block">Connect With Us</span>
            <h2 class="text-2xl font-bold text-gray-800 mb-3 heading-font">Follow SmartShop</h2>
            <div class="divider w-14 h-px mx-auto my-3"></div>
            <p class="text-gray-600 max-w-2xl mx-auto mb-6 text-sm">Stay connected for the latest updates and offers.</p>

            <div class="flex justify-center space-x-4">
                <a href="#" class="social-icon w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 hover:text-blue-600">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 hover:text-pink-600">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="social-icon w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 hover:text-blue-400">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-icon w-10 h-10 flex items-center justify-center rounded-lg text-gray-700 hover:text-red-600">
                    <i class="fab fa-youtube"></i>
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
            const map = L.map('map').setView([34.0522, -118.2437], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Custom icon
            const storeIcon = L.divIcon({
                className: 'store-icon',
                html: '<div class="bg-white p-2 rounded-full shadow-md"><i class="fas fa-store text-gray-800"></i></div>',
                iconSize: [0, 0],
                iconAnchor: [20, 40],
                popupAnchor: [0, -40]
            });

            // Add a marker with custom icon
            const marker = L.marker([34.0522, -118.2437], {icon: storeIcon}).addTo(map)
                .bindPopup(`
                    <div class="font-semibold text-gray-800 text-sm">SmartShop Headquarters</div>
                    <div class="text-gray-600 text-xs">123 Shop Street, Commerce City</div>
                `);

            // Open popup by default
            marker.openPopup();
        });
    </script>
</body>
</html>