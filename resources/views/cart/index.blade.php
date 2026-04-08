@extends('layouts.app')
@section('title', '🛒 Your Shopping Cart')

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-bottom-0">
                    <h4 class="fw-bold mb-0 text-dark">Shopping Cart ({{ count($cart) }} Items)</h4>
                </div>

                <div class="card-body p-0">
                    @forelse($cart as $id => $item)
                    @php 
                        // Image decoding logic
                        $images = is_string($item['image']) ? json_decode($item['image'], true) : $item['image'];
                        $displayImg = is_array($images) && count($images) ? $images[0] : 'default.jpg';
                    @endphp

                    <div class="p-4 border-bottom item-row" id="item-row-{{ $id }}">
                        <div class="row align-items-center">
                            <div class="col-3 col-md-2 text-center">
                                <img src="{{ asset('storage/products/' . $displayImg) }}"
                                     class="img-fluid rounded-3 shadow-sm"
                                     style="height:85px; width:85px; object-fit:cover;"
                                     onerror="this.src='{{ asset('images/no-image.png') }}'">
                            </div>

                            <div class="col-9 col-md-4">
                                <h6 class="fw-bold mb-1 text-truncate">{{ $item['name'] }}</h6>
                                <span class="text-success fw-bold fs-5">₹{{ number_format($item['sale_price']) }}</span>
                            </div>

                            <div class="col-6 col-md-3 mt-3 mt-md-0">
                                <div class="d-flex align-items-center border rounded-pill px-2 py-1 bg-light shadow-xs" style="width: fit-content;">
                                    <button type="button" class="btn btn-sm btn-white rounded-circle shadow-sm btn-qty" 
                                            onclick="updateCart('{{ $id }}', -1)">
                                        <i class="fas fa-minus small"></i>
                                    </button>

                                    <span id="qty-{{ $id }}" class="mx-3 fw-bold text-dark fs-6">
                                        {{ $item['quantity'] }}
                                    </span>

                                    <button type="button" class="btn btn-sm btn-white rounded-circle shadow-sm btn-qty" 
                                            onclick="updateCart('{{ $id }}', 1)">
                                        <i class="fas fa-plus small"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="col-6 col-md-3 text-end mt-3 mt-md-0">
                                <div class="fw-bold fs-5 text-dark mb-1" id="price-{{ $id }}">
                                    ₹{{ number_format($item['sale_price'] * $item['quantity']) }}
                                </div>

                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 small text-decoration-none hover-underline">
                                        <i class="fas fa-trash-alt me-1"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-shopping-basket fa-4x text-light"></i>
                            </div>
                            <h4 class="text-muted">Aapka cart khali hai!</h4>
                            <p class="text-secondary small">Shuruat karein hamare taaza products ke saath.</p>
                            <a href="{{ url('/') }}" class="btn btn-success rounded-pill px-5 mt-3 shadow-sm">
                                Start Shopping
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        @if(count($cart) > 0)
        <div class="col-lg-4">
            <div class="card p-4 shadow-sm border-0 rounded-4 sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4">Order Summary</h5>
                
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-bold">₹<span id="subTotal">{{ number_format($totalAmount) }}</span></span>
                </div>

                <div class="d-flex justify-content-between mb-3 small">
                    <span class="text-muted">Delivery Charges</span>
                    <span class="text-success">FREE</span>
                </div>

                <hr class="text-muted opacity-25">

                <div class="d-flex justify-content-between mb-4">
                    <span class="h5 fw-bold text-dark">Total Amount</span>
                    <span class="h5 fw-bold text-success">₹<span id="totalAmount">{{ number_format($totalAmount) }}</span></span>
                </div>

                <a href="{{ route('checkout.shipping') }}" class="btn btn-success btn-lg w-100 rounded-pill shadow fw-bold py-3">
                   Proceed to Checkout <i class="fas fa-arrow-right ms-2 small"></i>
                </a>

                <div class="mt-4 text-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" height="15" class="mx-2 opacity-50" alt="paypal">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b7/MasterCard_Logo.svg" height="15" class="mx-2 opacity-50" alt="mastercard">
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateCart(id, change) {
    const qtySpan = document.getElementById('qty-' + id);
    let currentQty = parseInt(qtySpan.innerText);
    
    // Safety check
    if (currentQty + change < 1) return;

    // Loading State
    const buttons = document.querySelectorAll('.btn-qty');
    buttons.forEach(btn => btn.disabled = true);

    fetch(`/cart/update/${id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ change: change })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            // Smoothly update UI
            qtySpan.innerText = data.quantity;
            document.getElementById('price-' + id).innerText = '₹' + data.itemTotal.toLocaleString();
            
            // Global totals update
            const totalElements = ['totalAmount', 'subTotal'];
            totalElements.forEach(elId => {
                const el = document.getElementById(elId);
                if(el) el.innerText = data.total.toLocaleString();
            });
        } else {
            alert(data.message || "Stock limit reached!");
        }
    })
    .catch(err => {
        console.error("Cart error:", err);
    })
    .finally(() => {
        // Re-enable buttons
        buttons.forEach(btn => btn.disabled = false);
    });
}
</script>
@endpush

@push('styles')
<style>
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
    .btn-white { background: #fff; border: 1px solid #eee; }
    .item-row { transition: background 0.3s ease; }
    .item-row:hover { background-color: #fafafa; }
    .btn-qty:disabled { opacity: 0.6; cursor: not-allowed; }
</style>
@endpush