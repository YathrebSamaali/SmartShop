@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 250px; background-color: #f8f9fa; padding: 20px;">
    <div class="container-fluid">
        <div class="bg-white rounded-lg shadow-md p-6 max-w-3xl mx-auto">
            <!-- Header with Title and Close Button -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="h3 mb-1 text-gray-800">Edit User: {{ $user->name }}</h1>
                <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            <!-- Tips Section -->
            <div class="alert alert-info border-left-primary shadow-sm mb-4">
                <div class="d-flex align-items-center">
                    <div>
                        <strong><i class="fas fa-lightbulb mr-2"></i> Quick Tips:</strong>
                        <ul class="mb-1 ps-3" style="list-style-type: circle;">
                            <li><strong>Password Requirements:</strong> Leave blank to keep current password</li>
                            <li><strong>Administrators:</strong> Have full system access privileges</li>
                            <li><strong>Email Validation:</strong> Must be unique and properly formatted</li>
                            <li><strong>Editing:</strong> All changes are logged for security</li>
                        </ul>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Name Field -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" id="name"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" id="email"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" name="password" id="password"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="Leave blank to keep current">
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Confirmation Field -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                               placeholder="Leave blank to keep current">
                    </div>

                    <!-- Role Field -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select name="is_admin" id="role"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <option value="0" {{ !$user->is_admin ? 'selected' : '' }}>Standard User</option>
                            <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Administrator</option>
                        </select>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex justify-end space-x-4 mt-8">
                    <a href="{{ route('admin.users.index') }}"
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                            class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200" style="background-color:rgb(19, 216, 118);">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
