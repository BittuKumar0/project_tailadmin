@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card shadow-lg p-5">
                <h2 class="fw-bold text-success mb-4">💰 Cash on Delivery</h2>
                <p class="fs-5 mb-4">Your order has been placed successfully! You will pay when the product is delivered.</p>
                <a href="{{ route('order.success') }}" class="btn btn-primary btn-lg">Go to Order Success Page</a>
            </div>
        </div>
    </div>
</div>
@endsection