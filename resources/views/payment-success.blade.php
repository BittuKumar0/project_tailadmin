@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-5">
                    <!-- Success Icon -->
                    <div class="mb-4">
                        <div class="checkmark-circle mx-auto mb-3">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="40" cy="40" r="35" stroke="#28a745" stroke-width="5" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20 40 L34 54 L60 26" stroke="#28a745" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                            </svg>
                        </div>
                        <h1 class="display-4 text-success mb-1">Payment Successful!</h1>
                        <p class="lead text-muted">Thank you for your purchase</p>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary bg-light p-4 rounded mb-4">
    <h5 class="mb-3"><i class="fas fa-receipt text-primary me-2"></i>Order Summary</h5>
    <div class="row text-start">
        <div class="col-md-6">
            <p class="mb-2"><strong>Product:</strong></p>
            <p class="mb-2"><strong>Amount:</strong></p>
            <p class="mb-2"><strong>Transaction ID:</strong></p>
            <p class="mb-0"><strong>Date:</strong></p>
        </div>
        <div class="col-md-6">
            <p class="mb-2">{{ $product->name ?? 'Product Name' }}</p>
            <p class="mb-2 text-success fw-bold fs-5">₹{{ number_format($product->price ?? 0, 2) }}</p>
            <p class="mb-2 text-primary">{{ $paymentIntent ?? 'N/A' }}</p>
            <p class="mb-0">{{ now()->format('M d, Y h:i A') }}</p>
        </div>
    </div>
</div>

                    <!-- Next Steps -->
                    <div class="row mt-4">
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-envelope fa-2x text-info mb-3"></i>
                                    <h6>Check Your Email</h6>
                                    <p class="text-muted small">Receipt sent to your registered email</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body text-center p-4">
                                    <i class="fas fa-download fa-2x text-warning mb-3"></i>
                                    <h6>Download Invoice</h6>
                                    <a href="#" class="btn btn-outline-primary btn-sm">Download PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-5">
                        <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg px-4 me-3">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.checkmark-circle {
    width: 80px;
    height: 80px;
    position: relative;
}

.order-summary {
    border-left: 4px solid #28a745;
}
</style>

@if(session('success'))
    <script>
        // Optional: Trigger celebration animation or analytics
        console.log('Payment completed successfully!');
        // gtag('event', 'purchase', {...}); // Google Analytics
    </script>
@endif
@endsection
