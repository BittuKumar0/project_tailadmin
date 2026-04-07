@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row gap-4">

        <!-- LEFT: Product Summary -->
        <div class="col-lg-5 bg-white p-4 rounded shadow-sm">
            <h4 class="fw-bold mb-3">Your Item</h4>
            <div class="d-flex align-items-start gap-3">
                <img src="{{ asset('storage/'.$product->images->first()->image_path ?? 'images/no-image.png') }}"
                     class="img-fluid border p-2" style="width:120px;">
                <div class="flex-grow-1">
                    <h5 class="fw-bold">{{ $product->name }}</h5>
                    <p class="text-muted mb-1">{{ $product->description }}</p>
                    <p class="text-danger fw-bold mb-1">₹<span id="price">{{ number_format($product->price) }}</span></p>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <label class="mb-0 fw-bold">Quantity:</label>
                        <input type="number" id="quantity" value="1" min="1" class="form-control w-25"
                               onchange="document.getElementById('quantityInput').value = this.value; updateSubtotal(this.value);">
                        <input type="hidden" name="quantity" id="quantityInput" value="1">
                    </div>
                    <p class="fw-bold">Subtotal: ₹<span id="subtotal">{{ number_format($product->price) }}</span></p>
                </div>
            </div>
        </div>

        <!-- RIGHT: Checkout Form -->
        <div class="col-lg-6 bg-white p-4 rounded shadow-sm">
            <h4 class="fw-bold mb-3">Shipping & Payment</h4>
            <form id="checkoutForm" action="{{ route('checkout.process', $product->id) }}" method="POST">
                @csrf

                <!-- Shipping Info -->
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Shipping Address</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>

                <!-- Payment Method -->
                <div class="mb-3">
                    <select id="paymentMethod" name="payment_method" class="form-select" required>
                        <option value="">-- Select Payment --</option>
                        <option value="cod">Cash on Delivery</option>
                        <option value="card">Credit/Debit Card</option>
                    </select>
                </div>

                <!-- Stripe Card Input -->
                <div id="card-container" class="mb-4" style="display:none;">
                    <label class="form-label">Card Details</label>
                    <div id="card-element" class="form-control p-2"></div>
                    <div id="card-errors" class="text-danger mt-2"></div>
                </div>

                <button type="submit" id="payButton" class="btn btn-success w-100 py-2 fw-bold">Place Order</button>
            </form>
        </div>

    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe('{{ env("STRIPE_KEY") }}');
const elements = stripe.elements();
const cardElement = elements.create('card');
cardElement.mount('#card-element');

const paymentMethod = document.getElementById('paymentMethod');
const cardContainer = document.getElementById('card-container');
const checkoutForm = document.getElementById('checkoutForm');
const payButton = document.getElementById('payButton');
const cardErrors = document.getElementById('card-errors');

// Show/Hide card input
paymentMethod.addEventListener('change', function() {
    cardContainer.style.display = this.value === 'card' ? 'block' : 'none';
});

// Update subtotal dynamically
function updateSubtotal(qty){
    const price = {{ $product->price }};
    document.getElementById('subtotal').textContent = (price * qty).toLocaleString();
}

// Handle form submit
checkoutForm.addEventListener('submit', async function(e){
    if(paymentMethod.value === 'card'){
        e.preventDefault();
        payButton.disabled = true;

        const quantity = document.getElementById('quantity').value;

        // Create PaymentIntent via backend
        const response = await fetch("{{ route('checkout.stripe', $product->id) }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ quantity })
        });

        const data = await response.json();

        const { error } = await stripe.confirmCardPayment(data.client_secret, {
            payment_method: {
                card: cardElement,
                billing_details: {
                    name: checkoutForm.name.value,
                    email: checkoutForm.email.value
                }
            }
        });

        if(error){
            cardErrors.textContent = error.message;
            payButton.disabled = false;
        } else {
            checkoutForm.submit(); // Submit after successful payment
        }
    }
});
</script>
@endsection