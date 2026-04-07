@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Complete Your Order</h4>
                </div>
                <div class="card-body p-4">
                    <!-- Product Summary -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/'.($product->images->first()->image_path ?? 'images/no-image.png')) }}" 
                                 class="img-fluid rounded" style="height: 120px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <h5>{{ $product->name }}</h5>
                            <p class="text-muted">{{ Str::limit($product->description, 100) }}</p>
                            <p class="h5 text-danger fw-bold">₹{{ number_format($product->price) }}</p>
                            <small class="text-warning">Stock: {{ $product->stock }}</small>
                        </div>
                    </div>

                    <form action="{{ route('checkout.process', $product->id) }}" method="POST" id="paymentForm">
                        @csrf
                        <input type="hidden" name="quantity" value="1">
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone *</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Shipping Address *</label>
                            <textarea name="address" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Payment Method</label>
                            <select name="payment_method" class="form-select" id="paymentMethod" required>
                                <option value="">Select Payment</option>
                                <option value="cod">Cash on Delivery</option>
                                <option value="card">Credit/Debit Card</option>
                            </select>
                        </div>

                        <!-- Stripe Card -->
                        <div id="card-container" style="display:none;">
                            <label class="form-label">Card Details</label>
                            <div id="card-element" class="form-control p-3 border"></div>
                            <div id="card-errors" class="text-danger mt-2"></div>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="fas fa-lock me-2"></i>Place Order ₹{{ number_format($product->price) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe('{{ config("services.stripe.key") }}');
const elements = stripe.elements();
const cardElement = elements.create('card');

document.getElementById('paymentMethod').addEventListener('change', function() {
    const container = document.getElementById('card-container');
    if (this.value === 'card') {
        container.style.display = 'block';
        cardElement.mount('#card-element');
    } else {
        container.style.display = 'none';
        cardElement.unmount();
    }
});
</script>
@endsection
