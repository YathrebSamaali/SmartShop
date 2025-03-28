@extends('layouts.admin')

@section('content')
<div class="content" style="margin-left: 250px; padding: 20px;">
    <div class="container-fluid">
        <!-- Card Container -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden max-w-4xl mx-auto">
            <!-- Card Header -->
            <div class="flex justify-between items-center px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h1 class="text-xl font-semibold text-gray-800">User Details</h1>
                <a href="{{ route('admin.users.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>

            <!-- Card Body -->
            <div class="p-6">
                <!-- Profile Section -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8">
                    <!-- Avatar -->
                    <div class="relative">
                        <img class="w-28 h-28 rounded-full border-4 border-white shadow-lg"
                             src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random' }}"
                             alt="{{ $user->name }}">
                        <!-- Removed the white circle SVG here -->
                    </div>

                    <!-- User Info -->
                    <div class="flex-1">
                        <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-600 mb-3">{{ $user->email }}</p>

                        <!-- Badges -->
                        <div class="flex flex-wrap gap-2">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $user->is_admin ? 'Administrator' : 'Standard User' }}
                            </span>

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Account Info Card -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-xs">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                </svg>
                                Account Information
                            </h3>
                        </div>
                        <div class="px-4 py-3">
                            <dl class="space-y-3">
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-sm text-gray-500">ID</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $user->id }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-sm text-gray-500">Registration Date</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $user->created_at->format('m/d/Y H:i') }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-sm text-gray-500">Last Updated</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $user->updated_at->format('m/d/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-xs">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h3 class="text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                                Statistics
                            </h3>
                        </div>
                        <div class="px-4 py-3">
                            <dl class="space-y-3">
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-sm text-gray-500">Login Count</dt>
                                    <dd class="text-sm font-medium text-gray-900">{{ $user->login_count ?? 'N/A' }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-sm text-gray-500">Last Login</dt>
                                    <dd class="text-sm font-medium text-gray-900">
                                        {{ $user->last_login_at ? $user->last_login_at->format('m/d/Y H:i') : 'Never' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 border-t border-gray-200 pt-6">
                    <a href="{{ route('admin.users.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        Cancel
                    </a>

                    <a href="{{ route('admin.users.edit', $user->id) }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Edit
                    </a>

                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
                                onclick="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
