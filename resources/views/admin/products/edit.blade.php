@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 230px; background-color: #f8f9fa; ">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Edit Product</h1>
                <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                               class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 mb-2">Price (DT)</label>
                        <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}"
                               class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div class="mb-4">
                        <label for="stock" class="block text-gray-700 mb-2">Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}"
                               class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 mb-2">Category</label>
                        <select name="category" id="category"
                                class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            @foreach(['Women', 'Men', 'Shoes'] as $category)
                                <option value="{{ $category }}" {{ old('category', $product->category) == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 mb-2">Description</label>
                        <textarea name="description" id="description" rows="4"
                                  class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-6">
                        <label for="image" class="block text-gray-700 mb-2">Product Image</label>
                        <input type="file" name="image" id="image"
                               class="w-full p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @if($product->image)
                            <div class="mt-2">
                                <img src="{{ Storage::url($product->image) }}" alt="Current Image" class="h-20 w-20 object-cover rounded-md">
                                <p class="text-sm text-gray-500 mt-1">Current Image</p>
                            </div>
                        @endif
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200" style="background-color:rgb(19, 216, 118);">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
