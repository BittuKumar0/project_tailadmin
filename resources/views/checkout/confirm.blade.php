@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h2>Thank you, {{ $request->name }}!</h2>
    <p>You have successfully ordered <strong>{{ $request->quantity }}</strong> x <strong>{{ $product->name }}</strong>.</p>
    <p>Total Amount: <strong>₹{{ number_format($total) }}</strong></p>
    <p>Payment Method: {{ ucfirst($request->payment_method) }}</p>
    <p>Delivery Address: {{ $request->address }}</p>
    <a href="{{ route('product.show', $product->id) }}" class="btn btn-primary mt-3">Back to Product</a>
</div>
@endsection