<div class="sidebar bg-dark text-white d-flex flex-column p-4" style="height: 100vh; min-width: 250px;">
    <!-- Section Avatar & Admin Info -->
    <div class="text-center mb-4 pb-3 border-bottom border-secondary">
        <div class="position-relative d-inline-block mb-3">
            <img src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff&size=128"
                 class="rounded-circle border border-3 border-primary"
                 width="80"
                 alt="Admin Avatar"
                 style="box-shadow: 0 0 10px rgba(13, 138, 188, 0.5);">
            <span class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-2 border-white"
                  style="width: 15px; height: 15px;"></span>
        </div>
        <h5 class="mb-1">Admin User</h5>
    </div>

    <!-- Navigation Menu -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.admindashboard') }}" class="nav-link text-white d-flex align-items-center hover-effect">
                <i class="fas fa-tachometer-alt me-3 fs-5"></i>
                <span class="fs-6">Dashboard</span>
                <i class="fas fa-chevron-right ms-auto fs-6"></i>
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.users.index') }}" class="nav-link text-white d-flex align-items-center hover-effect">
                <i class="fas fa-users me-3 fs-5"></i>
                <span class="fs-6">User Management</span>
                <i class="fas fa-chevron-right ms-auto fs-6"></i>
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.products.index') }}" class="nav-link text-white d-flex align-items-center hover-effect">
                <i class="fas fa-box me-3 fs-5"></i>
                <span class="fs-6">Product Management</span>
                <i class="fas fa-chevron-right ms-auto fs-6"></i>
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.orders.index') }}" class="nav-link text-white d-flex align-items-center hover-effect">
                <i class="fas fa-cart-plus me-3 fs-5"></i>
                <span class="fs-6">Orders</span>
                <span class="badge bg-warning ms-auto">{{ App\Models\Order::count() }}</span>
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('admin.settings') }}" class="nav-link text-white d-flex align-items-center hover-effect">
                <i class="fas fa-cogs me-3 fs-5"></i>
                <span class="fs-6">Settings</span>
                <i class="fas fa-chevron-right ms-auto fs-6"></i>
            </a>
        </li>
    </ul>

    <!-- Logout Section -->
    <div class="mt-auto pt-3 border-top border-secondary">
        <a href="{{ route('admin.logout') }}" class="nav-link text-white d-flex align-items-center hover-effect logout-btn">
            <i class="fas fa-sign-out-alt me-3 fs-5"></i>
            <span class="fs-6">Logout</span>
            <i class="fas fa-chevron-right ms-auto fs-6"></i>
        </a>
    </div>

    <!-- Replace any GET logout links with a POST form -->
<form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-link text-decoration-none">
        <i class="fas fa-sign-out-alt"></i> Déconnexion
    </button>
</form>
</div>

<style>
    .sidebar {
        background: linear-gradient(135deg, #343a40 0%, #1a1e21 100%);
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .hover-effect {
        padding: 12px 15px;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .hover-effect:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateX(5px);
    }

    .hover-effect::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 3px;
        background-color: #0d6efd;
        transform: scaleY(0);
        transition: transform 0.2s ease;
    }

    .hover-effect:hover::before {
        transform: scaleY(1);
    }

    .logout-btn:hover {
        background-color: rgba(220, 53, 69, 0.2) !important;
        color: #dc3545 !important;
    }

    .nav-link.active {
        background-color: rgba(13, 110, 253, 0.2) !important;
        color: #0d6efd !important;
    }

    .nav-link.active i {
        color: inherit !important;
    }

    .badge {
        font-size: 0.65rem;
        padding: 0.35em 0.65em;
        font-weight: 600;
    }
</style>
