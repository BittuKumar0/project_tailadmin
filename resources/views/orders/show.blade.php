@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="container py-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark">
            <i class="fas fa-receipt text-success me-2"></i>
            Order Details
        </h3>

        <a href="{{ route('customer.orders') }}" class="btn btn-outline-success rounded-pill">
            ← Back to Orders
        </a>
    </div>

    <!-- Order Card -->
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-body p-4">

            <div class="row mb-3">
                <div class="col-md-6">
                    <p class="mb-1 text-muted">Order ID</p>
                    <h5 class="fw-bold text-primary">#{{ $order->order_id }}</h5>
                </div>

                <div class="col-md-6 text-md-end">
                    <p class="mb-1 text-muted">Order Date</p>
                    <h6>{{ $order->created_at->format('d M, Y') }}</h6>
                </div>
            </div>

            <hr>

            <!-- Product Info -->
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="fw-bold text-dark">
                        {{ $order->product_name }}
                    </h5>
                    <p class="text-muted mb-1">Quantity: {{ $order->quantity }}</p>
                </div>

                <div class="col-md-4 text-md-end">
                    <h5 class="fw-bold text-success">
                        ₹{{ number_format($order->total, 2) }}
                    </h5>
                </div>
            </div>

        </div>
    </div>

    <!-- Payment + Status -->
    <div class="row">

        <!-- Payment Info -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Payment Info</h5>

                    <p>
                        <strong>Method:</strong>
                        <span class="badge bg-secondary">
                            {{ strtoupper($order->payment_method) }}
                        </span>
                    </p>

                    <p>
                        <strong>Status:</strong>
                        @if($order->payment_status == 'paid')
                            <span class="badge bg-success">Paid</span>
                        @else
                            <span class="badge bg-warning text-dark">Pending</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Order Status -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-3">Order Status</h5>

                    <span class="badge px-4 py-2 fs-6
                        @if($order->status == 'ordered') bg-primary
                        @elseif($order->status == 'shipped') bg-info
                        @elseif($order->status == 'delivered') bg-success
                        @elseif($order->status == 'cancelled') bg-danger
                        @endif
                    ">
                        {{ ucfirst($order->status) }}
                    </span>

                </div>
            </div>
        </div>

    </div>

    <!-- Shipping Address -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Shipping Address</h5>

            <p class="mb-1"><strong>{{ $order->name }}</strong></p>
            <p class="mb-1">{{ $order->address }}</p>
            <p class="mb-1">{{ $order->city ?? '' }}, {{ $order->state ?? '' }}</p>
            <p class="mb-1">Pincode: {{ $order->pincode ?? '' }}</p>
            <p class="mb-0">Phone: {{ $order->phone }}</p>
        </div>
    </div>

</div>

<style>
.rounded-4 {
    border-radius: 1rem !important;
}

.card {
    transition: 0.2s ease;
}

.card:hover {
    transform: translateY(-2px);
}

.badge {
    font-size: 0.85rem;
}
</style>

@endsection