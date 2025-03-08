@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📊 Tableau de Bord Admin</h2>

    <div class="row">
        <!-- Total des commandes -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total des commandes</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalOrders }}</h5>
                </div>
            </div>
        </div>

        <!-- Total des produits -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total des produits</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalProducts }}</h5>
                </div>
            </div>
        </div>

        <!-- Chiffre d'affaire -->
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header">Chiffre d'affaire</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalRevenue }} €</h5>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphiques (exemple avec Chart.js) -->
    <div class="row">
        <div class="col-md-12">
            <h3>Statistiques des ventes mensuelles</h3>
            <canvas id="salesChart" width="400" height="200"></canvas>
        </div>
    </div>

    <!-- Liens pour gérer produits et commandes -->
    <div class="row mt-4">
        <div class="col-md-6">
            <a href="{{ route('admin.products') }}" class="btn btn-primary btn-block">Gérer les Produits</a>
        </div>
        <div class="col-md-6">
            <a href="{{ route('admin.orders') }}" class="btn btn-primary btn-block">Gérer les Commandes</a>
        </div>
    </div>
</div>

<!-- Scripts pour intégrer le graphique (Chart.js) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@endsection
