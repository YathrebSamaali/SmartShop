@extends('layouts.admin')

@section('content')
<div class="content-wrapper" style="background-color: #f8f9fa; margin-left:250px; padding: 20px;">
    <div class="container-fluid">
        <!-- Header with back button and breadcrumb -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1 text-gray-800">Order Details</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item active" aria-current="page">#{{ $order->order_number }}</li>
                    </ol>
                </nav>
            </div>
            <div class="flex justify-between items-center mb-6">
                <a href="{{ route('admin.orders.index') }}" class="text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </div>

        <!-- Main content row -->
        <div class="row mb-4">
            <!-- Left column - Order details -->
            <div class="col-md-8">
                <!-- Customer and order info card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Customer & Order Information</h5>
                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h6 class="text-muted mb-3"><i class="fas fa-user me-2"></i>Customer Details</h6>
                                    <div class="d-flex mb-2">
                                        <div style="width: 100px;">Name:</div>
                                        <div class="fw-bold">{{ $order->customer_first_name }} {{ $order->customer_last_name }}</div>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <div style="width: 100px;">Email:</div>
                                        <div>{{ $order->customer_email }}</div>
                                    </div>
                                    <div class="d-flex">
                                        <div style="width: 100px;">Phone:</div>
                                        <div>{{ $order->customer_phone ?? 'N/A' }}</div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="text-muted mb-3"><i class="fas fa-credit-card me-2"></i>Billing Address</h6>
                                    <address class="mb-0">
                                        {{ $order->billing_street }}<br>
                                        {{ $order->billing_city }}, {{ $order->billing_zip_code }}<br>
                                        {{ $order->billing_country }}
                                    </address>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h6 class="text-muted mb-3"><i class="fas fa-info-circle me-2"></i>Order Details</h6>
                                    <div class="d-flex mb-2">
                                        <div style="width: 120px;">Order #:</div>
                                        <div class="fw-bold">{{ $order->order_number }}</div>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <div style="width: 120px;">Date:</div>
                                        <div>{{ $order->created_at->format('M j, Y \a\t g:i A') }}</div>
                                    </div>
                                    <div class="d-flex mb-2">
                                        <div style="width: 120px;">Payment:</div>
                                        <div>
                                            <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                                {{ ucfirst($order->payment_status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="text-muted mb-3"><i class="fas fa-truck me-2"></i>Shipping Address</h6>
                                    <address class="mb-0">
                                        {{ $order->delivery_street }}<br>
                                        {{ $order->delivery_city }}, {{ $order->delivery_zip_code }}<br>
                                        {{ $order->delivery_country }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order items table -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Order Items ({{ $order->items->count() }})</h5>
                        <div class="text-muted">Total: {{ number_format($order->total, 2) }} DT</div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col" class="ps-4">Product</th>
                                        <th scope="col" class="text-end">Price</th>
                                        <th scope="col" class="text-center">Qty</th>
                                        <th scope="col" class="text-end pe-4">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                @if($item->product->image)
                                                    <img src="{{ asset('storage/'.$item->product->image) }}" alt="{{ $item->product->name }}"
                                                        class="img-thumbnail me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center me-3"
                                                        style="width: 60px; height: 60px;">
                                                        <i class="fas fa-box-open text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-1">{{ $item->product->name }}</h6>
                                                    <p class="text-muted mb-0">SKU: {{ $item->product->sku }}</p>
                                                    @if($item->variation)
                                                        <small class="text-muted">Variant: {{ $item->variation }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">{{ number_format($item->price, 2) }} DT</td>
                                        <td class="text-center">{{ $item->quantity }}</td>
                                        <td class="text-end pe-4">{{ number_format($item->price * $item->quantity, 2) }} DT</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Order notes section -->
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Order Notes</h5>
                    </div>
                    <div class="card-body">
                        @if($order->notes)
                            <div class="bg-light p-3 mb-3 rounded">
                                {!! nl2br(e($order->notes)) !!}
                            </div>
                        @endif

                        @can('edit orders')
                        <form action="{{ route('admin.orders.update-notes', $order) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="notes" class="form-label">Add Note</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3"
                                    placeholder="Add internal notes about this order..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Note</button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>

            <!-- Right column - Payment and actions -->
            <div class="col-md-4">
                <!-- Payment summary card -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="mb-0"><i class="fas fa-receipt me-2"></i>Payment Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Method:</span>
                            <span class="fw-bold">
                                @if($order->payment_method == 'credit_card')
                                    <i class="fas fa-credit-card me-1"></i> Credit Card
                                @elseif($order->payment_method == 'paypal')
                                    <i class="fab fa-paypal me-1"></i> PayPal
                                @elseif($order->payment_method == 'bank_transfer')
                                    <i class="fas fa-university me-1"></i> Bank Transfer
                                @else
                                    {{ ucfirst($order->payment_method) }}
                                @endif
                            </span>
                        </div>

                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal:</span>
                                <span>{{ number_format($order->subtotal, 2) }} DT</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Shipping:</span>
                                <span>{{ number_format($order->shipping_cost, 2) }} DT</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Tax:</span>
                                <span>{{ number_format($order->tax_amount, 2) }} DT</span>
                            </div>
                            @if($order->discount_amount > 0)
                            <div class="d-flex justify-content-between mb-2 text-danger">
                                <span class="text-muted">Discount:</span>
                                <span>-{{ number_format($order->discount_amount, 2) }} DT</span>
                            </div>
                            @endif
                        </div>

                        <div class="border-top pt-3 mt-2">
                            <div class="d-flex justify-content-between fw-bold fs-5">
                                <span>Total:</span>
                                <span>{{ number_format($order->total, 2) }} DT</span>
                            </div>
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
</div>
@endsection

@section('styles')
<style>
    .breadcrumb {
        background-color: transparent;
        padding: 0;
        font-size: 0.875rem;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        content: "›";
        padding: 0 0.5rem;
    }

    .card {
        border-radius: 0.5rem;
        border: 1px solid rgba(0,0,0,.05);
    }

    .card-header {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid rgba(0,0,0,.05);
    }

    .img-thumbnail {
        padding: 0.25rem;
        background-color: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
        max-width: 100%;
        height: auto;
    }

    .timeline {
        position: relative;
        padding-left: 1.5rem;
    }

    .timeline-item {
        position: relative;
        padding-bottom: 1.5rem;
    }

    .timeline-badge {
        position: absolute;
        left: -0.5rem;
        top: 0;
        width: 1rem;
        height: 1rem;
        border-radius: 50%;
        z-index: 1;
    }

    .timeline-content {
        padding-left: 1rem;
    }

    .table thead th {
        border-bottom: 1px solid rgba(0,0,0,.05);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    .table tbody tr:last-child td {
        border-bottom: none;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-resize textarea for notes
        const textarea = document.getElementById('notes');
        if (textarea) {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        }

        // Confirm before changing status to cancelled
        const statusSelect = document.querySelector('select[name="status"]');
        if (statusSelect) {
            statusSelect.addEventListener('change', function(e) {
                if (e.target.value === 'cancelled') {
                    if (!confirm('Are you sure you want to cancel this order?')) {
                        e.target.value = '{{ $order->status }}';
                    }
                }
            });
        }
    });
</script>
@endsection
