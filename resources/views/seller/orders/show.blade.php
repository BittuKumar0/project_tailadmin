@extends('layouts.app')

@section('title', 'Seller Order Details - #' . $order->order_id)

@push('styles')
<style>
    .order-card { border-radius: 15px; border: none; transition: transform 0.2s; }
    .status-timeline { border-left: 2px solid #e9ecef; position: relative; padding-left: 20px; }
    .timeline-item::before {
        content: ""; position: absolute; left: -9px; top: 0;
        width: 16px; height: 16px; border-radius: 50%;
        background: #198754; border: 3px solid #fff; box-shadow: 0 0 5px rgba(0,0,0,0.1);
    }
    .info-label { color: #6c757d; font-size: 0.75rem; text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px; }
    .bg-soft-success { background-color: #e8f5e9; color: #1b5e20; }
    .whatsapp-btn { background-color: #25D366; color: white; border: none; }
    .whatsapp-btn:hover { background-color: #128C7E; color: white; }
    /* OTP Styling */
    .otp-display { 
        background: #fff3cd; 
        border: 2px dashed #ffc107; 
        color: #856404; 
        font-family: 'Courier New', Courier, monospace;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
    @endif

    {{-- Top Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold text-dark mb-1">Order #{{ $order->order_id }}</h3>
            <p class="text-muted small mb-0">Managed by Seller: <span class="fw-bold text-success">{{ Auth::user()->name }}</span></p>
        </div>
        <div class="d-flex gap-2">
            @if(strtolower($order->status) == 'pending')
                <button class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#assignCourierModal">
                    <i class="fas fa-truck me-1"></i> Confirm & Assign
                </button>
            @endif
            <a href="{{ url('/seller/orders') }}" class="btn btn-light border btn-sm rounded-pill px-3">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row g-4">
        {{-- Main Column --}}
        <div class="col-lg-8">
            {{-- Items Card --}}
            <div class="card order-card shadow-sm mb-4">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between">
                    <h6 class="mb-0 fw-bold">Items Summary</h6>
                    <span class="badge bg-soft-success rounded-pill px-3">Qty: {{ $order->quantity }}</span>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center p-3 border rounded-4 bg-light">
                        <div class="bg-white p-2 rounded-3 shadow-sm">
                            <i class="fas fa-box fa-2x text-success"></i>
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h6 class="fw-bold mb-1 text-slate-800">{{ $order->product_name }}</h6>
                            <p class="text-muted small mb-0">Rate: ₹{{ number_format($order->price, 2) }}</p>
                        </div>
                        <div class="text-end">
                            <span class="info-label d-block">Total Amount</span>
                            <span class="fw-black fs-5 text-success">₹{{ number_format($order->total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                {{-- Address Card --}}
                <div class="col-md-6">
                    <div class="card order-card shadow-sm h-100 border-start border-4 border-success">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i>Delivery Location</h6>
                            <p class="mb-1 fw-bold text-dark">{{ $order->user->name ?? $order->name }}</p>
                            <p class="text-muted small mb-2 lh-base">
                                <strong>Address:</strong> {{ $order->address }}
                            </p>
                            <div class="d-flex gap-2 mt-3">
                                <a href="tel:{{ $order->phone }}" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                    <i class="fas fa-phone-alt me-1"></i> Call User
                                </a>
                                <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode($order->address) }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-directions me-1"></i> Maps
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Courier & OTP Card --}}
                <div class="col-md-6">
                    <div class="card order-card shadow-sm h-100 border-start border-4 border-primary">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3"><i class="fas fa-shield-alt text-primary me-2"></i>Delivery Verification</h6>
                            @if($order->courier_name)
                                <div class="p-3 rounded-4 otp-display text-center mb-3">
                                    <span class="info-label d-block mb-1 text-dark">Verification OTP</span>
                                    <h3 class="fw-bold mb-0" style="letter-spacing: 5px;">{{ $order->delivery_otp ?? '----' }}</h3>
                                    <small class="text-muted" style="font-size: 10px;">Give this to the Courier for confirmation</small>
                                </div>
                                <div class="bg-light p-2 rounded-3 border">
                                    <p class="mb-0 small text-dark"><strong>Courier:</strong> {{ $order->courier_name }}</p>
                                    <p class="mb-0 small text-dark"><strong>Contact:</strong> {{ $order->courier_phone }}</p>
                                </div>
                                <a href="https://wa.me/91{{ $order->courier_phone }}?text=Order%20Assignment%20#{{ $order->order_id }}%0AOTP:%20{{ $order->delivery_otp }}%0AAddress:%20{{ urlencode($order->address) }}" target="_blank" class="btn whatsapp-btn btn-sm w-100 rounded-pill mt-3 shadow-sm">
                                    <i class="fab fa-whatsapp me-1"></i> Send Details to Courier
                                </a>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-truck-loading fa-3x text-muted opacity-25 mb-3"></i>
                                    <p class="text-muted small mb-0">Wait for assignment</p>
                                    <button class="btn btn-link text-decoration-none small p-0" data-bs-toggle="modal" data-bs-target="#assignCourierModal">Assign now</button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            <div class="card order-card shadow-sm mb-4 border-top border-5 border-success">
                <div class="card-body">
                    <h6 class="fw-bold mb-4">Order Life-Cycle</h6>
                    <div class="status-timeline">
                        <div class="timeline-item mb-4">
                            <h6 class="fw-bold mb-0 small uppercase">Order Received</h6>
                            <small class="text-muted">{{ $order->created_at->format('d M, h:i A') }}</small>
                        </div>
                        @if($order->status == 'shipped' || $order->status == 'delivered')
                        <div class="timeline-item mb-4">
                            <h6 class="fw-bold mb-0 small uppercase">Shipped & Assigned</h6>
                            <small class="text-muted">{{ $order->updated_at->format('d M, h:i A') }}</small>
                        </div>
                        @endif
                        <div class="timeline-item mb-0 {{ $order->status == 'delivered' ? '' : 'opacity-50 text-muted' }}">
                            <h6 class="fw-bold mb-0 small uppercase">Delivered</h6>
                            <small>Pending Verification</small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="text-center p-3 bg-light rounded-4">
                        <span class="info-label d-block mb-2">Payment Status</span>
                        <span class="badge {{ $order->payment_status == 'paid' ? 'bg-success' : 'bg-warning' }} px-3 rounded-pill text-uppercase">
                            {{ $order->payment_status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Assign Courier Modal --}}
<div class="modal fade" id="assignCourierModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-dark text-white border-0">
                <h6 class="modal-title fw-bold">Assign Delivery Boy</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('seller.orders.assign-courier', $order->id) }}" method="POST">
                @csrf
                <div class="modal-body p-4 text-center">
                    <i class="fas fa-shipping-fast fa-3x text-primary mb-3"></i>
                    <p class="small text-muted mb-4">Enter courier details to generate secure OTP and notify customer.</p>
                    
                    <div class="mb-3 text-start">
                        <label class="info-label mb-1">Name of Courier</label>
                        <input type="text" name="courier_name" class="form-control rounded-pill border-2" placeholder="Rahul Kumar" required>
                    </div>
                    <div class="mb-4 text-start">
                        <label class="info-label mb-1">Phone (WhatsApp)</label>
                        <input type="tel" name="courier_phone" class="form-control rounded-pill border-2" placeholder="9876543210" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">
                        CONFIRM & SHIP ORDER
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection