<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
        }

        .sidebar a {
            color: #ddd;
            padding: 10px 15px;
            text-decoration: none;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-header {
            background-color: #343a40;
            color: #fff;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center text-white">Admin Panel</h3>
        <ul class="list-unstyled">
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li><a href="#"><i class="fas fa-users"></i> Users Management</a></li>
            <li><a href="#"><i class="fas fa-box"></i> Products Management</a></li>
            <li><a href="#"><i class="fas fa-cart-plus"></i> Orders Management</a></li>
            <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav>

        <div class="container mt-4">
            <div class="header-title">
                <h4>Welcome to Admin Dashboard</h4>
            </div>

            <!-- Dashboard Overview Cards -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Users</h5>
                        </div>
                        <div class="card-body">
                            <p>Total number of users: 150</p>
                            <button class="btn btn-primary">View Users</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Orders</h5>
                        </div>
                        <div class="card-body">
                            <p>Total orders: 80</p>
                            <button class="btn btn-primary">View Orders</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Settings</h5>
                        </div>
                        <div class="card-body">
                            <p>Manage your site settings here.</p>
                            <button class="btn btn-primary">Go to Settings</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Activity -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5>Latest Activity</h5>
                </div>
                <div class="card-body">
                    <ul>
                        <li>User John Doe registered at 10:15 AM</li>
                        <li>New order received from user Alice at 9:30 AM</li>
                        <li>Settings were updated by admin at 8:45 AM</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
