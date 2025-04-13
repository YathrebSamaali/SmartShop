@extends('layouts.admin')

@section('content')
<div class="content-wrapper" style="background-color: #f8f9fa; margin-left:250px; padding: 20px;">
    <div class="container-fluid">
        <!-- Header with back button -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Order Details</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">#{{ $order->order_number }}</li>
                    </ol>
                </nav>
            </div>
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Order summary card -->
        <div class="row mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h6 class="text-muted mb-3">Customer Information</h6>
                                    <p class="mb-1"><strong>Name:</strong> {{ $order->customer_first_name }} {{ $order->customer_last_name }}</p>
                                    <p class="mb-1"><strong>Email:</strong> {{ $order->customer_email }}</p>
                                    <p class="mb-1"><strong>Phone:</strong> {{ $order->customer_phone ?? 'N/A' }}</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="text-muted mb-3">Billing Address</h6>
                                    <p class="mb-1">{{ $order->billing_street }}</p>
                                    <p class="mb-1">{{ $order->billing_city }}, {{ $order->billing_zip_code }}</p>
                                    <p class="mb-1">{{ $order->billing_country }}</p>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h6 class="text-muted mb-3">Order Information</h6>
                                    <p class="mb-1"><strong>Order #:</strong> {{ $order->order_number }}</p>
                                    <p class="mb-1"><strong>Date:</strong> {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                                    <p class="mb-1"><strong>Status:</strong>
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="text-muted mb-3">Shipping Address</h6>
                                    <p class="mb-1">{{ $order->delivery_street }}</p>
                                    <p class="mb-1">{{ $order->delivery_city }}, {{ $order->delivery_zip_code }}</p>
                                    <p class="mb-1">{{ $order->delivery_country }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">Payment Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Payment Method:</span>
                            <span class="fw-bold">
                                @if($order->payment_method == 'credit_card')
                                    <i class="fas fa-credit-card me-1"></i> Credit Card
                                @elseif($order->payment_method == 'paypal')
                                    <i class="fab fa-paypal me-1"></i> PayPal
                                @else
                                    <i class="fas fa-university me-1"></i> Bank Transfer
                                @endif
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Payment Status:</span>
                            <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Subtotal:</span>
                            <span>{{ number_format($order->subtotal, 2) }} DT</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Shipping:</span>
                            <span>{{ number_format($order->shipping_cost, 2) }} DT</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Tax:</span>
                            <span>{{ number_format($order->tax_amount, 2) }} DT</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>Total:</span>
                            <span>{{ number_format($order->total, 2) }} DT</span>
                        </div>
                    </div>
                </div>

                <!-- Actions card -->
                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-header bg-white border-bottom">
                        <h5 class="mb-0">Order Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.invoice', $order) }}" class="btn btn-outline-primary">
                                <i class="fas fa-file-pdf me-2"></i> Generate Invoice
                            </a>

                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="d-grid">
                                @csrf
                                <div class="input-group mb-3">
                                    <select name="status" class="form-select">
                                        @foreach(['pending' => 'Pending', 'processing' => 'Processing', 'completed' => 'Completed', 'cancelled' => 'Cancelled'] as $value => $label)
                                            <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>

                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-grid">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete this order?')">
                                    <i class="fas fa-trash-alt me-2"></i> Delete Order
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order items table -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0">Order Items ({{ $order->items->count() }})</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th scope="col" class="ps-4">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}" class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                                                <i class="fas fa-box-open text-muted"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <h6 class="mb-1">{{ $item->product->name }}</h6>
                                            <p class="text-muted mb-0">SKU: {{ $item->product->sku }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ number_format($item->price, 2) }} DT</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price * $item->quantity, 2) }} DT</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order notes -->
        <div class="card shadow-sm border-0 mt-4">
            <div class="card-header bg-white border-bottom">
                <h5 class="mb-0">Order Notes</h5>
            </div>

        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .breadcrumb {
        background-color: transparent;
        padding: 0;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }

    .card-header {
        padding: 1rem 1.5rem;
    }

    .timeline-item {
        position: relative;
        padding-left: 1.5rem;
    }

    .timeline-item::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background-color: #dee2e6;
    }

    .img-thumbnail {
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-resize textarea for notes
        const textarea = document.getElementById('note');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        }
    });
</script>
@endsection
