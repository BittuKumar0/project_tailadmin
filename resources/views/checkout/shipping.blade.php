@extends('layouts.app')
@section('title', '🚚 Shipping Details')

@section('content')
<div class="bg-light py-3 border-bottom mb-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-success text-decoration-none">Cart</a></li>
                <li class="breadcrumb-item active">Shipping Address</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-4">
    <div class="row g-4">
        <!-- Shipping Form -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-header bg-white border-0 py-4 px-4">
                    <h4 class="fw-bold mb-0">
                        <i class="fas fa-map-marker-alt text-success me-2"></i>Delivery Address
                    </h4>
                    <p class="text-muted small mb-0">Please fill in your correct address for fast delivery.</p>
                </div>
                <div class="card-body p-4 pt-0">
                    <form action="{{ route('checkout.shipping') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" placeholder="John Doe" required>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="+91 9876543210" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="example@email.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="address" id="address" class="form-control" placeholder="Street address, house no." required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="City" required>
                            </div>
                            <div class="col-md-6">
                                <label for="state" class="form-label">State</label>
                                <input type="text" name="state" id="state" class="form-control" placeholder="State" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" name="pincode" id="pincode" class="form-control" placeholder="123456" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 py-2">Continue to Payment</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 rounded-4 sticky-top" style="top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 text-dark border-bottom pb-2">Order Summary</h5>

                    <div class="cart-items-preview mb-4" style="max-height: 280px; overflow-y: auto;">
                        @php $total = 0; @endphp
                        @foreach(Session::get('cart', []) as $item)
                            @php
                                // Handle image array safely
                                $image = $item['image'] ?? 'images/no-image.jpg';
                                if (is_array($image)) {
                                    $image = $image[0] ?? 'images/no-image.jpg';
                                }
                            @endphp
                            <div class="d-flex align-items-center mb-3">
                              
                                <div class="ms-3 flex-grow-1">
                                    <h6 class="mb-0 small fw-bold text-dark">{{ Str::limit($item['name'], 25) }}</h6>
                                    <small class="text-muted">₹{{ number_format($item['sale_price'], 0) }}</small>
                                </div>
                                <div class="text-end">
                                    <span class="fw-bold small text-dark">₹{{ number_format($item['sale_price'] * $item['quantity'], 0) }}</span>
                                </div>
                            </div>
                            @php $total += ($item['sale_price'] * $item['quantity']); @endphp
                        @endforeach
                    </div>

                    <div class="pricing-details bg-light p-3 rounded-3 mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Subtotal</span>
                            <span class="fw-bold small">₹{{ number_format($total, 0) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Shipping</span>
                            <span class="text-success fw-bold small">FREE</span>
                        </div>
                        <hr class="my-2 border-secondary opacity-10">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-dark">Total Amount</span>
                            <span class="h4 fw-bold text-success mb-0">₹{{ number_format($total, 0) }}</span>
                        </div>
                    </div>

                    <div class="security-badges text-center">
                        <div class="d-flex justify-content-center gap-3 mb-2">
                            <i class="fas fa-lock text-muted small"></i>
                            <i class="fab fa-cc-visa text-muted fs-5"></i>
                            <i class="fab fa-cc-mastercard text-muted fs-5"></i>
                            <i class="fas fa-truck text-muted fs-5"></i>
                        </div>
                        <p class="text-muted" style="font-size: 11px;">100% Secure Payment & Genuine Products</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control:focus, .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1);
    }
    .cart-items-preview::-webkit-scrollbar { width: 4px; }
    .cart-items-preview::-webkit-scrollbar-thumb { background: #dee2e6; border-radius: 10px; }
    .input-group-text { border-right: none; }
</style>
@endsection