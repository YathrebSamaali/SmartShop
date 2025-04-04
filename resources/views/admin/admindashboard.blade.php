<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Sidebar CSS -->
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
        }

        .stat-card {
            border-left: 4px solid;
        }

        .stat-card.users {
            border-left-color: #4e73df;
        }

        .stat-card.products {
            border-left-color: #1cc88a;
        }

        .stat-card.orders {
            border-left-color: #f6c23e;
        }

        .stat-card.revenue {
            border-left-color: #e74a3b;
        }

        .chart-container {
            position: relative;
            height: 300px;
        }

        .recent-orders {
            max-height: 400px;
            overflow-y: auto;
        }

        .order-status-badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
        }
    </style>
</head>

<body>

@include('admin.includes.sidebar')

    <!-- Main Content -->
    <div class="content" style="background-color: #f8f9fa; margin-left:250px; min-height:100vh;">
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <h5 class="mb-0 text-gray-800">Tableau de bord</h5>
                <div class="d-flex align-items-center">
                    <span class="me-3 small text-muted">{{ \Carbon\Carbon::now()->format('l, d F Y') }}</span>
                </div>
            </div>
        </nav>

        <div class="container-fluid py-4">
            <!-- Stats Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card users h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted mb-2">Utilisateurs</h6>
                                    <h2 class="mb-0">1,248</h2>
                                    <p class="text-success mb-0">
                                        <span class="fas fa-arrow-up"></span> 12.5%
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <div class="icon-shape bg-primary text-white rounded-circle">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card products h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted mb-2">Produits</h6>
                                    <h2 class="mb-0">356</h2>
                                    <p class="text-success mb-0">
                                        <span class="fas fa-arrow-up"></span> 5.3%
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <div class="icon-shape bg-success text-white rounded-circle">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card orders h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted mb-2">Commandes</h6>
                                    <h2 class="mb-0">1,024</h2>
                                    <p class="text-danger mb-0">
                                        <span class="fas fa-arrow-down"></span> 3.2%
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <div class="icon-shape bg-warning text-white rounded-circle">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card revenue h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="text-uppercase text-muted mb-2">Revenu</h6>
                                    <h2 class="mb-0">€24,780</h2>
                                    <p class="text-success mb-0">
                                        <span class="fas fa-arrow-up"></span> 8.1%
                                    </p>
                                </div>
                                <div class="col-auto">
                                    <div class="icon-shape bg-danger text-white rounded-circle">
                                        <i class="fas fa-euro-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row mb-4">
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Ventes mensuelles</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="salesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Statut des commandes</h6>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="ordersStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders & Top Products -->
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Commandes récentes</h6>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-link">Voir tout</a>
                        </div>
                        <div class="card-body recent-orders">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>N° Commande</th>
                                            <th>Client</th>
                                            <th>Montant</th>
                                            <th>Statut</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#ORD-2023-0012</td>
                                            <td>Jean Dupont</td>
                                            <td>€125.99</td>
                                            <td><span class="badge bg-success order-status-badge">Livré</span></td>
                                            <td>15/06/2023</td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-2023-0011</td>
                                            <td>Marie Lambert</td>
                                            <td>€89.50</td>
                                            <td><span class="badge bg-warning text-dark order-status-badge">En traitement</span></td>
                                            <td>14/06/2023</td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-2023-0010</td>
                                            <td>Pierre Martin</td>
                                            <td>€210.00</td>
                                            <td><span class="badge bg-info order-status-badge">Expédié</span></td>
                                            <td>13/06/2023</td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-2023-0009</td>
                                            <td>Sophie Bernard</td>
                                            <td>€56.75</td>
                                            <td><span class="badge bg-danger order-status-badge">Annulé</span></td>
                                            <td>12/06/2023</td>
                                        </tr>
                                        <tr>
                                            <td>#ORD-2023-0008</td>
                                            <td>Thomas Leroy</td>
                                            <td>€175.30</td>
                                            <td><span class="badge bg-primary order-status-badge">Nouveau</span></td>
                                            <td>11/06/2023</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Produits populaires</h6>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-link">Voir tout</a>
                        </div>
                        <div class="card-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Smartphone X1</h6>
                                        <small class="text-muted">Électronique</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">128 ventes</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Casque Audio Pro</h6>
                                        <small class="text-muted">Accessoires</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">89 ventes</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Montre Connectée</h6>
                                        <small class="text-muted">Accessoires</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">76 ventes</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Sac à dos Urbain</h6>
                                        <small class="text-muted">Mode</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">65 ventes</span>
                                </a>
                                <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="mb-1">Bottes en Cuir</h6>
                                        <small class="text-muted">Chaussures</small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">54 ventes</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Chart.js Scripts -->
    <script>
        // Sales Chart
        const salesCtx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'],
                datasets: [{
                    label: 'Ventes 2023 (€)',
                    data: [12500, 11800, 14200, 15600, 17800, 19500, 21000, 20500, 19800, 18500, 17200, 22400],
                    backgroundColor: 'rgba(78, 115, 223, 0.05)',
                    borderColor: 'rgba(78, 115, 223, 1)',
                    pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            callback: function(value) {
                                return '€' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        // Orders Status Chart
        const ordersStatusCtx = document.getElementById('ordersStatusChart').getContext('2d');
        const ordersStatusChart = new Chart(ordersStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Nouveau', 'En traitement', 'Expédié', 'Livré', 'Annulé'],
                datasets: [{
                    data: [15, 22, 18, 35, 10],
                    backgroundColor: [
                        '#4e73df',
                        '#f6c23e',
                        '#36b9cc',
                        '#1cc88a',
                        '#e74a3b'
                    ],
                    hoverBackgroundColor: [
                        '#2e59d9',
                        '#dda20a',
                        '#2c9faf',
                        '#17a673',
                        '#be2617'
                    ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }]
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                },
                cutout: '70%',
            }
        });
    </script>
</body>

</html>
