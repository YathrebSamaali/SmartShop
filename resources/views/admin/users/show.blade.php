@extends('layouts.admin')

@section('content')
<div class="content" >
<div class="container-fluid px-0" style="margin-left: 120px;" > <!-- Suppression du padding horizontal -->
<!-- Card Container avec largeur adaptative - J'ai augmenté la max-width à 7xl -->
        <div class="bg-white rounded-lg shadow-md p-6 mx-auto" style="max-width: 85%;"> <!-- Augmentation de la largeur max -->
            <!-- Card Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="h3 mb-1 text-gray-800"> User Details: </h1>
                <a href="{{ route('admin.users.index') }}" class="text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>


            <!-- Card Body - J'ai augmenté le padding -->
            <div class="p-8">
                <!-- Profile Section -->
                <div class="flex flex-col md:flex-row items-start md:items-center gap-8 mb-10">
                    <!-- Avatar - Taille augmentée -->
                    <div class="relative">
                        <img class="w-32 h-32 rounded-full border-4 border-white shadow-lg"
                             src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=random' }}"
                             alt="{{ $user->name }}">
                    </div>

                    <!-- User Info -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-lg text-gray-600 mb-4">{{ $user->email }}</p>

                        <!-- Badges - Taille augmentée -->
                        <div class="flex flex-wrap gap-3">
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium
                                {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{ $user->is_admin ? 'Administrator' : 'Standard User' }}
                            </span>

                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-medium
                                {{ $user->email_verified_at ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                {{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Details Grid - Espacement augmenté -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <!-- Account Info Card -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-xs">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200">
                            <h3 class="text-base font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                    <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                </svg>
                                Account Information
                            </h3>
                        </div>
                        <div class="px-5 py-4">
                            <dl class="space-y-4">
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-base text-gray-500">ID</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ $user->id }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-base text-gray-500">Registration Date</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ $user->created_at->format('m/d/Y H:i') }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-base text-gray-500">Last Login</dt>
                                    <dd class="text-base font-medium text-gray-900">
                                        {{ $user->last_login_at ? $user->last_login_at->format('m/d/Y H:i') : 'Never' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Statistics Card -->
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-xs">
                        <div class="bg-gray-50 px-5 py-4 border-b border-gray-200">
                            <h3 class="text-base font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                                </svg>
                                Statistics
                            </h3>
                        </div>
                        <div class="px-5 py-4">
                            <dl class="space-y-4">
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-base text-gray-500">Login Count</dt>
                                    <dd class="text-base font-medium text-gray-900">{{ $user->login_count ?? 'N/A' }}</dd>
                                </div>
                                <div class="flex justify-between items-center py-2">
                                    <dt class="text-base text-gray-500">Last Login IP</dt>
                                    <dd class="text-base font-medium text-gray-900">
                                        {{ $user->last_login_ip ?? 'N/A' }}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons - Taille augmentée -->
                <div class="flex justify-end space-x-4 border-t border-gray-200 pt-8">
                    <a href="{{ route('admin.users.index') }}"
                       class="px-6 py-3 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition duration-200 text-base">
                        Cancel
                    </a>

                    <a href="{{ route('admin.users.edit', $user->id) }}"
                       class="px-6 py-3 border border-gray-300 rounded-lg text-white hover:bg-gray-100 transition duration-200 text-base"
                       style="background-color:rgb(19, 216, 118);">
                        Edit Account
                    </a>

                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="px-6 py-3 border border-gray-300 rounded-lg text-white focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 text-base"
                                style="background-color:rgb(244, 18, 18);"
                                onclick="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.')">
                            Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection