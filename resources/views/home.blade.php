@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    <!-- Affichage de l'utilisateur actuel -->
                    <div class="mt-3">
                        <h5>{{ __('Welcome back, ') }}{{ Auth::user()->name }}</h5>
                        <p>{{ __('Your email: ') }}{{ Auth::user()->email }}</p>
                    </div>

                    <!-- Si l'utilisateur est un admin -->
                    @if(Auth::user()->role === 'admin')
                        <div class="mt-4">
                            <h5>{{ __('Admin Actions') }}</h5>
                            <ul>
                                <li><a href="{{ route('admin.dashboard') }}">{{ __('Go to Admin Dashboard') }}</a></li>
                                <li><a href="{{ route('admin.products') }}">{{ __('Manage Products') }}</a></li>
                                <li><a href="{{ route('admin.orders') }}">{{ __('Manage Orders') }}</a></li>
                            </ul>
                        </div>
                    @endif

                    <!-- Ajouter un graphique ou un tableau (exemple) -->
                    <div class="mt-4">
                        <h5>{{ __('Sales Analytics') }}</h5>
                        <p>{{ __('Here, you can display a sales chart or other analytics data.') }}</p>
                        <!-- Tu peux ajouter un graphique ici avec une bibliothèque comme Chart.js ou une table -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
