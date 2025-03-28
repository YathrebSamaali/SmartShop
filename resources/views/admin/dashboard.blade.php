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
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

        <!-- Sidebar CSS -->
        <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
</head>

<body>

@include('admin.includes.sidebar')

    <!-- Main Content -->
    <div class="content" style="margin-left: 260px; background-color: #f8f9fa; min-height: 100vh;">
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
