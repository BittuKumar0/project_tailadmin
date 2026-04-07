@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>

    @php
        $cart = $cart ?? [];
        $totalAmount = $totalAmount ?? 0;
    @endphp

    @if(is_array($cart) && count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item['name'] ?? 'N/A' }}</td>
                        <td>{{ $item['quantity'] ?? 0 }}</td>
                        <td>${{ number_format($item['sale_price'] ?? 0, 2) }}</td>
                        <td>${{ number_format(($item['sale_price'] ?? 0) * ($item['quantity'] ?? 0), 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total: ${{ number_format($totalAmount, 2) }}</h3>
        
      <form action="{{ route('checkout.process', $shipping_id) }}" method="POST">

            @csrf

            <label>
                <input type="radio" name="payment_method" value="cod" checked> Cash on Delivery
            </label>
            <label>
                <input type="radio" name="payment_method" value="stripe"> Card (Stripe)
            </label>

            <div id="stripe-fields" style="display:none; margin-top: 10px;">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" name="card_number" class="form-control" placeholder="Card Number" maxlength="19">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="exp_month" class="form-control" placeholder="MM" maxlength="2">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="exp_year" class="form-control" placeholder="YY" maxlength="4">
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="cvc" class="form-control" placeholder="CVC" maxlength="4">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success mt-3">Pay Now ${{ number_format($totalAmount, 2) }}</button>
        </form>
    @else
        <div class="alert alert-info">
            <p>Your cart is empty. <a href="{{ route('cart.index') }}">Continue Shopping</a></p>
        </div>
    @endif
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('input[name="payment_method"]').forEach(el => {
        el.addEventListener('change', function() {
            document.getElementById('stripe-fields').style.display = this.value === 'stripe' ? 'block' : 'none';
        });
    });
});
</script>
@push('styles')
<style>
    #stripe-fields input { margin-bottom: 10px; }
</style>
@endpush
