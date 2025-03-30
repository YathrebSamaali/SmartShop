@extends('layouts.admin')

@section('content')
<div class="content" style="background-color: #f8f9fa; padding: 20px;">
    <div class="container-fluid px-0">
        <div class="bg-white rounded-lg shadow-md p-6 mx-auto w-full">
            <!-- Header with Title and Close Button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="h3 mb-1 text-gray-800">Add New Product</h1>
                <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>



            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Product Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name *</label>
                        <input type="text" name="name" id="name"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price Field -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price (DT) *</label>
                        <input type="number" step="0.01" name="price" id="price"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               required>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock Field -->
                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-700 mb-1">Stock Quantity *</label>
                        <input type="number" name="stock" id="stock"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               required>
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Field -->
                    <div>
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                        <select name="category" id="category"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                required>
                            <option value="">Select Category</option>
                            <option value="Women">Women</option>
                            <option value="Men">Men</option>
                            <option value="Shoes">Shoes</option>
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Field -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Product Image *</label>
                        <input type="file" name="image" id="image"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               accept="image/jpeg,image/png,image/jpg">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description Field -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description *</label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                                  required></textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('admin.products.index') }}"
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition duration-200" style="background-color:rgb(19, 216, 118);">
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
