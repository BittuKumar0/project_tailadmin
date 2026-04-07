@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h3 class="mb-4">Secure Card Payment</h3>

    @if(empty($cart))
        <p>Your cart is empty</p>
    @else
        @foreach($cart as $item)
            <p>{{ $item['name'] }}</p>
            <p>₹{{ $item['sale_price'] }}</p>
            <p>Qty: {{ $item['quantity'] }}</p>
            <hr>
        @endforeach

        <h3>Total: ₹{{ $totalAmount }}</h3>

        <form id="payment-form">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Card Details</label>
                <div id="card-element" class="form-control p-3"></div>
                <div id="card-errors" class="text-danger mt-2"></div>
            </div>

            <button id="payBtn" class="btn btn-success w-100">
                Pay Now - ₹{{ number_format($totalAmount, 2) }}
            </button>
        </form>
    @endif
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
const stripe = Stripe("{{ config('services.stripe.key') }}");
const elements = stripe.elements();

const card = elements.create('card');
card.mount('#card-element');

const form = document.getElementById('payment-form');
const payBtn = document.getElementById('payBtn');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    payBtn.disabled = true;

    try {
        const response = await fetch("{{ route('create.payment.intent') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        });

        // Handle server error
        if (!response.ok) {
            const text = await response.text();
            console.error(text);
            alert("Server error");
            payBtn.disabled = false;
            return;
        }

        const data = await response.json();

        if (data.error) {
            alert(data.error);
            payBtn.disabled = false;
            return;
        }

        const result = await stripe.confirmCardPayment(data.client_secret, {
            payment_method: {
                card: card
            }
        });

        if (result.error) {
            document.getElementById('card-errors').textContent = result.error.message;
            payBtn.disabled = false;
        } else {
        if (result.paymentIntent.status === 'succeeded') {
 
    window.location.href = "{{ route('stripe.success') }}";
}
        }

    } catch (error) {
        console.error(error);
        alert("Something went wrong");
        payBtn.disabled = false;
    }
});
</script>
@endsection