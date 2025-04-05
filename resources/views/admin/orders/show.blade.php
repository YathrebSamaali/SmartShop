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
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Order #</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th class="text-end pe-4">Actions</th>
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
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <div class="small">
                                        {{ $order->created_at->format('m/d/Y') }}
                                        <div class="text-muted">{{ $order->created_at->format('H:i') }}</div>
                                    </div>
                                </td>
                                <td class="align-middle fw-semibold">
                                    {{ number_format($order->total, 2) }} DT
                                </td>
                                <td class="align-middle">
                                    <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'processing' ? 'primary' : ($order->status == 'cancelled' ? 'danger' : 'warning')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
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
                                <td class="pe-4 align-middle text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.invoice', $order) }}"
                                           class="btn btn-sm btn-outline-success"
                                           title="Invoice">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this order?')">
                                                <i class="fas fa-trash-alt"></i>
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

@push('styles')
<style>
.bg-solid {
    background-color: #e9ecef;
    border: 1px solid rgba(0,0,0,0.05);
}

.search-container {
    border: 1px solid #dee2e6;
    border-radius: 6px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.search-container:focus-within {
    box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.25);
    border-color: #86b7fe;
}

.search-container .input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.search-container .form-control {
    border-left: none;
    box-shadow: none;
}

.clear-search-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    z-index: 5;
    background: transparent;
    border: none;
    cursor: pointer;
}

.table tr {
    height: 60px;
}

.table td {
    vertical-align: middle;
}

.empty-state {
    max-width: 500px;
    margin: 0 auto;
}

.empty-state-icon {
    width: 80px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 20px;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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
});

function clearSearch() {
    const url = new URL(window.location.href);
    url.searchParams.delete('search');
    window.location.href = url.toString();
}
</script>
@endpush