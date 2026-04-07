@extends('layouts.app')
@section('title', 'Payment Success')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    <div class="text-success mb-4">
                        <i class="fas fa-check-circle fa-5x mb-3"></i>
                        <h1 class="display-4 fw-bold">Payment Successful!</h1>
                        <p class="lead">Thank you for your order</p>
                    </div>
                    
                    <div class="alert alert-success">
                        <h5>✅ Order Confirmed</h5>
                        <p>Your payment of <strong>₹790</strong> has been processed successfully.</p>
                        <p class="mb-0">We'll deliver your order within 2-3 days.</p>
                    </div>

                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="btn btn-success btn-lg px-4 me-2">
                            <i class="fas fa-shopping-bag me-2"></i>Continue Shopping
                        </a>
                        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-lg px-4">
                            <i class="fas fa-receipt me-2"></i>View Orders
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
