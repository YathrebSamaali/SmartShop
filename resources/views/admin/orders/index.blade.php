@extends('layouts.admin')

@section('content')
<div class="content-wrapper" style="background-color: #f8f9fa; margin-left:250px; padding: 20px;">
    <div class="container-fluid">
        <!-- Enhanced header with breadcrumbs -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Order Management</h1>
                <p class="text-muted mb-0">{{ $orders->total() }} order(s) found</p>
            </div>

            <!-- Enhanced search bar -->
            <div class="d-flex align-items-center">
                <form method="GET" action="{{ route('admin.orders.index') }}" class="d-flex align-items-center mt-3">
                    <div class="input-group search-container" style="width: 250px;">
                        <span class="input-group-text">
                            <i class="fas fa-search text-secondary"></i>
                        </span>
                        <input type="text"
                               name="search"
                               class="form-control border-start-0 ps-2 py-2"
                               placeholder="Search orders..."
                               value="{{ request('search') }}"
                               aria-label="Search"
                               id="instantSearchInput"
                               style="border-radius: 0 4px 4px 0;">

                        @if(request('search'))
                        <button type="button"
                                class="input-group-text bg-transparent border-0 clear-search-btn"
                                onclick="clearSearch()"
                                title="Clear search">
                            <i class="fas fa-times text-muted"></i>
                        </button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle me-2"></i>
                <div>
                    {{ session('success') }}
                    @if(session('order_id'))
                    <a href="{{ route('admin.orders.show', session('order_id')) }}" class="alert-link ms-2">View order</a>
                    @endif
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Main card -->
        <div class="card shadow-sm border-0">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-solid from-blue-50 to-indigo-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Order #</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Customer</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Address</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Amount</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-semibold text-indigo-800 uppercase tracking-wider">Payment</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-indigo-800 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-indigo-800 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="ps-4 align-middle">
                                    <div class="fw-semibold">{{ $order->order_number }}</div>
                                    <small class="text-muted">Ref: {{ $order->id }}</small>
                                </td>
                                <td class="align-middle">
                                    <div class="flex-grow-1 ms-3">
                                        <div class="fw-medium">{{ $order->customer_first_name }} {{ $order->customer_last_name }}</div>
                                        <div class="text-muted small">{{ $order->customer_email }}</div>
                                        <div class="text-muted small">{{ $order->customer_phone ?? 'N/A' }}</div>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="small">
                                        <div class="fw-medium">{{ $order->delivery_street }}</div>
                                        <div>{{ $order->delivery_city }}</div>
                                        <div>{{ $order->delivery_zip_code }}</div>
                                        <div class="text-muted">{{ $order->delivery_country }}</div>
                                    </div>
                                </td>
                                <td class="align-middle fw-semibold">
                                    {{ number_format($order->total, 2) }} DT
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-inline">
                                        @csrf
                                        <select name="status"
                                                onchange="this.form.submit()"
                                                class="form-select form-select-sm status-select status-{{ $order->status }}"
                                                style="width: auto; display: inline-block;">
                                            @foreach(['pending' => 'Pending', 'processing' => 'Processing', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
                                            <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center">
                                        @if($order->payment_method == 'credit_card')
                                        <i class="fas fa-credit-card me-2 text-primary"></i>
                                        @elseif($order->payment_method == 'paypal')
                                        <i class="fab fa-paypal me-2 text-primary"></i>
                                        @else
                                        <i class="fas fa-university me-2 text-primary"></i>
                                        @endif
                                        <span>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="small text-muted">
                                        {{ $order->created_at->format('m/d/Y') }}
                                        <div class="text-muted">{{ $order->created_at->format('H:i') }}</div>
                                    </div>
                                </td>
                                <td class="px-4 py-2 whitespace-nowrap text-right action-cell">
                                    <div class="flex justify-end space-x-2">
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                        class="text-blue-600 p-1"
                                           title="View Details">
                                            <i class="fas fa-eye fa-sm"></i>
                                        </a>
                                        <a href="{{ route('admin.invoice', $order) }}"
                                        class="text-green-600 p-1"
                                           title="Invoice">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                            class="text-red-600 p-1"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this order?')">
                                                <i class="fas fa-trash-alt fa-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Enhanced pagination -->
                @if($orders->hasPages())
                <div class="card-footer bg-white border-top">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="mb-2 mb-md-0">
                            <p class="mb-0 text-muted">
                                Showing <span class="fw-semibold">{{ $orders->firstItem() }}</span> to <span class="fw-semibold">{{ $orders->lastItem() }}</span> of <span class="fw-semibold">{{ $orders->total() }}</span> orders
                            </p>
                        </div>
                        <div>
                            {{ $orders->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
                @endif
            @else
                <div class="card-body text-center py-5">
                    <div class="empty-state">
                        <div class="empty-state-icon bg-light-primary">
                            <i class="fas fa-shopping-cart fa-3x text-primary"></i>
                        </div>
                        <h3 class="mt-4">No orders found</h3>
                        <p class="text-muted mb-4">
                            @if(request('search'))
                            Your search for "{{ request('search') }}" returned no results.
                            @else
                            No orders have been recorded yet.
                            @endif
                        </p>
                        @if(request('search') || request('status') || request('payment'))
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">
                            <i class="fas fa-undo me-2"></i> Reset filters
                        </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

<style>
.bg-solid {
    background-color: #e9ecef;
    border: 1px solid rgba(0,0,0,0.05);
}
.border-indigo-100 {
    border-color:rgba(255, 255, 255, 0.5);
}
.table-container {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05),
                0 2px 4px -1px rgba(0, 0, 0, 0.02);
}
.table tr {
    height: 60px;
}
.table td {
    padding-top: 0.5rem !important;
    padding-bottom: 0.5rem !important;
    vertical-align: middle !important;
}
.table th {
    padding-top: 0.75rem !important;
    padding-bottom: 0.75rem !important;
}
.avatar-cell {
    width: 40px !important;
    padding-right: 0 !important;
}
.avatar-img {
    width: 36px !important;
    height: 36px !important;
}
.action-cell {
    white-space: nowrap;
    width: 120px;
}
.search-container {
    border: 1px solid #212529;
    border-radius: 6px;
    overflow: hidden;
    background-color: transparent;
    transition: all 0.3s ease;
    margin-right: 10px;
}
.search-container:focus-within {
    box-shadow: 0 0 0 2px rgba(33, 37, 41, 0.25);
}

.search-container .input-group-text {
    background-color: transparent !important;
    border-right: none !important;
    border-color: #212529 !important;
}

.search-container .form-control {
    background-color: transparent !important;
    border-color: #212529 !important;
    border-left: none !important;
    box-shadow: none !important;
}
.form-control {
    font-size: 0.95rem;
    height: 38px;
    border: 1px solid #212529 !important;
    border-left: none !important;
    border-right: none !important;
}
.clear-search-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 5;
    background: transparent !important;
    border: none !important;
    cursor: pointer;
    color: #dc3545 !important;
}

.clear-search-btn i {
    font-size: 0.9rem;
}

.no-results-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
}
.input-group-text {
    background-color:rgb(248, 250, 248) !important;
    border-right: none !important;
    padding: 0 12px;
}
.fa-search {
    font-size: 0.9rem;
    color: #212529;
}
.input-group-text,
.form-control,
.clear-search-btn {
    margin: -1px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Instant search
    const searchInput = document.getElementById('instantSearchInput');
    if (searchInput) {
        let searchTimer;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function() {
                searchInput.form.submit();
            }, 500);
        });

        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                this.form.submit();
            }
        });
    }

    // Auto-close alerts
    const alertMessage = document.querySelector('.alert');
    if (alertMessage) {
        setTimeout(function() {
            alertMessage.style.transition = "opacity 0.5s";
            alertMessage.style.opacity = "0";
            setTimeout(() => alertMessage.style.display = "none", 500);
        }, 5000);
    }
});

function clearSearch() {
    const url = new URL(window.location.href);
    url.searchParams.delete('search');
    window.location.href = url.toString();
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>