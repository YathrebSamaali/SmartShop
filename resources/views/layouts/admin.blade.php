<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <!-- Font Awesome for icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

        <!-- Sidebar CSS -->
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gray-100">
        <div class="d-flex">
            <!-- Sidebar Include -->
            @include('admin.includes.sidebar')

            <!-- Main Content -->
            <div class="flex-1 ms-64 p-4">
                @yield('content')
            </div>
        </div>


    <!-- Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    </body>
</html>

<!--<head>
    <link rel="stylesheet" href="{{ asset('vendor/admin-lte/css/adminlte.min.css') }}">
</head>
<body>
    <script src="{{ asset('vendor/admin-lte/js/adminlte.min.js') }}"></script>
</body>-->
