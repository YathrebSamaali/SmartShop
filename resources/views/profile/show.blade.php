@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6">Your Profile</h1>

    <div class="bg-white rounded-lg shadow overflow-hidden p-6">
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Name:</label>
            <p class="text-gray-900">{{ auth()->user()->name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-medium mb-2">Email:</label>
            <p class="text-gray-900">{{ auth()->user()->email }}</p>
        </div>
        <!-- Ajoutez d'autres informations de profil au besoin -->
    </div>
</div>
@endsection
