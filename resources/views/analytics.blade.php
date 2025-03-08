@extends('layouts.app')

@section('content')
<div class="container">
    <h2>📊 Prévisions des ventes</h2>

    <!-- Affichage du graphique des ventes -->
    <canvas id="salesChart"></canvas>

    <div class="row mt-4">
        <!-- Statistiques des ventes -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('Total des ventes') }}
                </div>
                <div class="card-body">
                    <p>{{ __('Total des ventes réalisées cette semaine: ') }} $5000</p>
                </div>
            </div>
        </div>

        <!-- Produits populaires -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('Produits populaires') }}
                </div>
                <div class="card-body">
                    <ul>
                        <li>{{ __('Produit A') }} - 120 ventes</li>
                        <li>{{ __('Produit B') }} - 98 ventes</li>
                        <li>{{ __('Produit C') }} - 75 ventes</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Actions pour l'admin -->
        @if(Auth::user()->role === 'admin')
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        {{ __('Actions rapides') }}
                    </div>
                    <div class="card-body">
                        <ul>
                            <li><a href="{{ route('admin.products') }}">{{ __('Gérer les produits') }}</a></li>
                            <li><a href="{{ route('admin.orders') }}">{{ __('Gérer les commandes') }}</a></li>
                            <li><a href="{{ route('analytics.sales') }}">{{ __('Voir les prévisions des ventes') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Script pour Chart.js (Graphique) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var salesChart = new Chart(ctx, {
        type: 'line', // Type de graphique (ici un graphique linéaire)
        data: {
            labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'], // Mois
            datasets: [{
                label: 'Prévisions des ventes',
                data: [1200, 1400, 800, 1500, 1900, 2200], // Données de prévisions
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
