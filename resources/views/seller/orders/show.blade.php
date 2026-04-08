@extends('layouts.app')

@section('title', 'Order Details - #' . $order->order_id)

@push('styles')
<style>
    .order-card { border-radius: 15px; border: none; }
    .status-timeline { border-left: 2px solid #e9ecef; position: relative; padding-left: 20px; }
    .timeline-item::before {
        content: ""; position: absolute; left: -9px; top: 0;
        width: 16px; height: 16px; border-radius: 50%;
        background: #28a745; border: 3px solid #fff; shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    .info-label { color: #6c757d; font-size: 0.85rem; text-transform: uppercase; font-weight: 600; }
    .product-img { width: 80px; height: 80px; object-fit: cover; border-radius: 10px; }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Order #{{ $order->order_id }}</h3>
            <p class="text-muted small mb-0">Placed on {{ $order->created_at->format('d M Y, h:i A') }}</p>
        </div>
        <div class="d-flex gap-2">
            <button onclick="window.print()" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                <i class="fas fa-print me-1"></i> Print Invoice
            </button>
            <a href="{{ url()->previous() }}" class="btn btn-success btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card order-card shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold">Items Ordered</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center p-2 border rounded-3 bg-light-subtle">
                       <!-- #region -->
                        <div class="flex-grow-1 ms-4">
                            <h6 class="fw-bold mb-1">{{ $order->product_name }}</h6>
                            <p class="text-muted small mb-0">Qty: {{ $order->quantity }} x ₹{{ number_format($order->price) }}</p>
                        </div>
                        <div class="text-end">
                            <span class="fw-bold fs-5 text-success">₹{{ number_format($order->total) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card order-card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3"><i class="fas fa-truck text-success me-2"></i>Shipping Address</h6>
                            <p class="mb-1 fw-bold text-dark">{{ $order->user->name ?? $order->name }}</p>
                            <p class="text-muted small mb-3">
                                {{ $order->address }}<br>
                                {{ $order->phone }}<br>
                                {{ $order->email }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card order-card shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3"><i class="fas fa-credit-card text-success me-2"></i>Payment Details</h6>
                            <div class="mb-2">
                                <span class="info-label">Method:</span>
                                <span class="badge bg-light text-dark border ms-2 text-uppercase">{{ $order->payment_method }}</span>
                            </div>
                            <div>
                                <span class="info-label">Status:</span>
                                <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} ms-2 text-uppercase">
                                    {{ $order->payment_status }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card order-card shadow-sm mb-4 border-top border-5 border-success">
                <div class="card-body">
                    <h6 class="fw-bold mb-4">Order Progress</h6>
                    
                    <div class="status-timeline">
                        <div class="timeline-item mb-4">
                            <h6 class="fw-bold mb-0">Ordered</h6>
                            <small class="text-muted">{{ $order->created_at->format('d M, H:i') }}</small>
                        </div>
                        
                        <div class="timeline-item mb-0 text-muted opacity-50">
                            <h6 class="fw-bold mb-0">Processing / Delivered</h6>
                            <small>Pending update</small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="text-center">
                        <span class="info-label d-block mb-2">Current Status</span>
                        <h4 class="badge bg-success py-2 px-4 rounded-pill text-uppercase">{{ $order->status }}</h4>
                    </div>
                </div>
            </div>

            <div class="alert alert-success border-0 rounded-4 p-3 small">
                <i class="fas fa-info-circle me-2"></i> Customer support ke liye admin se contact karein agar status update nahi ho raha.
            </div>
        </div>
    </div>
</div>
@endsection