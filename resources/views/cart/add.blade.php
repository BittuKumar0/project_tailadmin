@extends('layouts.app')
@section('title', 'Shopping Cart')

@section('content')
<!-- Breadcrumb -->
<div class="bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Shopping Cart</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(empty($cart))
        <!-- Empty Cart -->
        <div class="row justify-content-center text-center py-5">
            <div class="col-md-6">
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart fa-5x text-muted mb-4"></i>
                    <h3 class="fw-bold mb-3">Your cart is empty</h3>
                    <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-lg rounded-pill px-4">
                        <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    @else
        <!-- Cart Items -->
        <div class="row g-4">
            <!-- Cart Table -->
            <div class="col-lg-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-white border-0 py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h2 class="fw-bold mb-1">
                                    <i class="fas fa-shopping-cart me-2 text-success"></i>
                                    Your Cart (<span id="cartCount">{{ count($cart) }}</span> items)
                                </h2>
                                <small class="text-muted">Review and update items before checkout</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        @foreach($cart as $id => $item)
                        <div class="cart-item p-4 border-bottom">
                            <div class="row align-items-center g-3">
                                <!-- Product Image -->
                                <div class="col-md-2">
                                    <img src="{{ asset($item['image']) }}" 
                                         class="img-fluid rounded shadow-sm" 
                                         style="height: 100px; object-fit: cover;"
                                         alt="{{ $item['name'] }}"
                                         onerror="this.src='https://via.placeholder.com/100x100/28a745/ffffff?text=Product'">
                                </div>
                                
                                <!-- Product Details -->
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-1">{{ $item['name'] }}</h5>
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        @if($item['regular_price'] > $item['sale_price'])
                                            <span class="text-muted text-decoration-line-through">
                                                ₹{{ number_format($item['regular_price'], 0) }}
                                            </span>
                                        @endif
                                        <span class="fw-bold text-danger fs-5">
                                            ₹{{ number_format($item['sale_price'], 0) }}
                                        </span>
                                    </div>
                                    <small class="text-success">In Stock: {{ $item['stock'] }} items</small>
                                </div>
                                
                                <!-- Quantity & Price -->
                                <div class="col-md-2">
                                    <div class="qty-group d-flex align-items-center gap-2">
                                        <button class="btn btn-outline-danger btn-sm rounded-circle qty-btn" 
                                                onclick="updateQty('{{ $id }}', -1)">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" 
                                               class="form-control qty-input text-center" 
                                               min="1" 
                                               max="{{ $item['stock'] }}"
                                               value="{{ $item['quantity'] }}"
                                               onchange="updateQty('{{ $id }}', this.value)"
                                               style="width: 70px;">
                                        <button class="btn btn-outline-success btn-sm rounded-circle qty-btn" 
                                                onclick="updateQty('{{ $id }}', 1)">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- Item Total & Remove -->
                                <div class="col-md-2 text-end">
                                    <div class="item-total fw-bold text-danger fs-5 mb-2">
                                        ₹{{ number_format($item['sale_price'] * $item['quantity'], 0) }}
                                    </div>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Remove this item?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card shadow-lg border-0 sticky-top" style="top: 20px;">
                    <div class="card-header bg-success text-white py-4">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-receipt me-2"></i>Order Summary
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-3">
                            <span>Items ({{ count($cart) }})</span>
                            <span id="itemsSubtotal">
                                ₹{{ number_format(array_sum(array_map(fn($item) => $item['sale_price'] * $item['quantity'], $cart)), 0) }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 p-3 bg-light rounded">
                            <span class="fw-bold fs-5">Total Amount</span>
                            <span class="display-5 fw-bold text-danger" id="cartTotal">
                                ₹{{ number_format($total, 0) }}
                            </span>
                        </div>
                        
                        <!-- Checkout Buttons -->
                        <div class="d-grid gap-2">
                            @auth
                                <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg fw-bold rounded-pill shadow-lg py-3 fs-5">
                                    <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-success btn-lg fw-bold rounded-pill shadow-lg py-3 fs-5">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login to Checkout
                                </a>
                            @endauth
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill">
                                <i class="fas fa-arrow-left me-2"></i>Continue Shopping
                            </a>
                        </div>

                        <!-- Free Shipping -->
                        <div class="text-center mt-4 p-3 bg-light rounded">
                            <i class="fas fa-shipping-fast text-success me-2"></i>
                            <span class="text-success fw-semibold">FREE shipping on orders over ₹999</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
function updateQty(productId, change) {
    const input = document.querySelector(`input[onchange="updateQty('${productId}', this.value)"]`);
    let currentQty = parseInt(input.value);
    const maxStock = parseInt(input.max);
    
    if (change === 'number') {
        currentQty = Math.max(1, Math.min(maxStock, parseInt(change)));
    } else {
        currentQty = Math.max(1, Math.min(maxStock, currentQty + parseInt(change)));
    }
    
    input.value = currentQty;
    
    // AJAX update
    fetch('{{ url("/cart/update") }}', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: currentQty
        })
    }).then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Refresh to update totals
        }
    });
}

// Delete form confirmation
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        if (!confirm('Are you sure you want to remove this item?')) {
            e.preventDefault();
        }
    });
});
</script>
@endpush

<style>
.qty-group {
    max-width: 150px;
}
.cart-item:hover {
    background-color: #f8f9fa;
    transition: 0.2s;
}
.qty-btn:hover {
    transform: scale(1.1);
}
.empty-cart i {
    opacity: 0.5;
}
</style>
@endsection
