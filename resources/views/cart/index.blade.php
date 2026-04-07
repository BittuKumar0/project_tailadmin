@extends('layouts.app')
@section('title', '🛒 Your Shopping Cart')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        {{-- Left Side: Cart Items --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h4 class="fw-bold mb-0">Shopping Cart ({{ count($cart) }} Items)</h4>
                </div>
      
                <div class="card-body p-0">
                    @if(empty($cart))
                        <div class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/11329/11329073.png" alt="Empty Cart" style="width: 120px; opacity: 0.5;">
                            <h5 class="mt-3 text-muted">Aapka cart khali hai!</h5>
                            <a href="{{ url('/') }}" class="btn btn-success rounded-pill px-4 mt-2">Shop Now</a>
                        </div>
                    @else
                        @foreach($cart as $id => $item)
                        @php 
                            $stock = $item['stock'] ?? 0; 
                            
                            // 🛑 IMAGE FIX LOGIC START
                            $imgData = $item['image'];
                            // Agar string hai toh decode karke array banayein
                            $images = is_string($imgData) ? json_decode($imgData, true) : $imgData;
                            
                            // Pehli image nikaalein, agar kuch na mile toh default lagayein
                            if (is_array($images) && count($images) > 0) {
                                $displayImg = $images[0];
                            } else {
                                $displayImg = is_string($imgData) ? $imgData : 'default.jpg';
                            }
                            // 🛑 IMAGE FIX LOGIC END
                        @endphp

                        <div class="p-3 border-bottom cart-item-row">
                            <div class="row align-items-center">
                                {{-- Product Image --}}
                                <div class="col-3 col-md-2 text-center">
                                    <img src="{{ asset('storage/products/' . $displayImg) }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="img-fluid rounded-3 border" 
                                         style="height: 80px; width: 80px; object-fit: cover;"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/80?text=No+Image';">
                                </div>

                                {{-- Details --}}
                                <div class="col-9 col-md-4">
                                    <h6 class="fw-bold mb-1">{{ Str::limit($item['name'], 50) }}</h6>
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="h6 fw-bold text-success mb-0">₹{{ number_format($item['sale_price'], 0) }}</span>
                                        @if(isset($item['regular_price']) && $item['regular_price'] > $item['sale_price'])
                                            <small class="text-muted text-decoration-line-through">₹{{ number_format($item['regular_price'], 0) }}</small>
                                        @endif
                                    </div>
                                    <div>
                                        @if($stock > 0)
                                            <span class="badge bg-success-subtle text-success border border-success px-2 py-1 small">
                                                <i class="fas fa-check-circle me-1"></i> In Stock
                                            </span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger border border-danger px-2 py-1 small">
                                                <i class="fas fa-times-circle me-1"></i> Out of Stock
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                {{-- Quantity Control --}}
                                <div class="col-6 col-md-3 mt-3 mt-md-0">
                                    <div class="input-group input-group-sm quantity-box" style="width: 110px;">
                                        <a href="{{ url('/cart/update-qty/'.$id.'/-1') }}" class="btn btn-outline-secondary">-</a>
                                        <input type="text" value="{{ $item['quantity'] }}" readonly class="form-control text-center fw-bold bg-white">
                                        <a href="{{ url('/cart/update-qty/'.$id.'/1') }}" class="btn btn-outline-secondary">+</a>
                                    </div>
                                </div>

                                {{-- Price & Remove --}}
                                <div class="col-6 col-md-3 text-end mt-3 mt-md-0">
                                    <div class="h6 fw-bold mb-1 text-dark">₹{{ number_format($item['sale_price'] * $item['quantity'], 0) }}</div>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-link text-danger text-decoration-none p-0 small">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        {{-- Right Side: Order Summary --}}
        @if(!empty($cart))
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px;">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">Price Details</h5>
                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Price ({{ count($cart) }} Items)</span>
                        <span>₹{{ number_format($totalAmount, 0) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3 text-muted">
                        <span>Delivery Charges</span>
                        <span class="text-success fw-bold">FREE</span>
                    </div>
                    <hr class="my-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-0">Total Amount</h5>
                        <h4 class="fw-bold text-success mb-0">₹{{ number_format($totalAmount, 0) }}</h4>
                    </div>

                    <a href="{{ route('checkout.shipping') }}" class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-bold shadow">
                        Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .cart-item-row:hover { background-color: #f8f9fa; }
    .bg-success-subtle { background-color: #e2f3ea !important; }
    .bg-danger-subtle { background-color: #fce8e8 !important; }
    .quantity-box .btn { border-color: #dee2e6; }
</style>
@endsection