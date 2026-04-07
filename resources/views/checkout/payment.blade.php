@extends('layouts.app')

@section('title', '💳 Payment Page')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-success text-white p-4">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-credit-card me-2"></i>Complete Your Order
                    </h4>
                </div>

                <div class="card-body p-5">
                    {{-- Order Summary --}}
                    <h5 class="fw-bold mb-4 border-bottom pb-2">Order Summary</h5>

                    @php 
                        $cart = Session::get('cart', []);
                        $totalAmount = 0;
                    @endphp

                    @foreach($cart as $id => $item)
                        @php
                            $totalAmount += ($item['sale_price'] * $item['quantity']);

                            // Fix for array images
                            $image = $item['image'] ?? 'images/no-image.png';
                            if (is_array($image)) {
                                $image = $image[0] ?? 'images/no-image.png';
                            }
                        @endphp

                        <div class="row mb-3 p-3 bg-light rounded-3 align-items-center">
                          
                            <div class="col-md-7">
                                <h6 class="fw-bold mb-1">{{ $item['name'] }}</h6>
                                <small class="text-muted">
                                    Qty: {{ $item['quantity'] }} × ₹{{ number_format($item['sale_price']) }}
                                </small>
                            </div>
                            <div class="col-md-3 text-end">
                                <span class="fw-bold text-success">
                                    ₹{{ number_format($item['sale_price'] * $item['quantity']) }}
                                </span>
                            </div>
                        </div>
                    @endforeach

                    <h5 class="mt-4">Shipping To:</h5>
                    <p>{{ $shipping->full_name }}, {{ $shipping->phone }}, {{ $shipping->address }}, {{ $shipping->city }}, {{ $shipping->state }} - {{ $shipping->pincode }}</p>

                    {{-- Payment Section --}}
                    <div class="row g-4 mb-5">
                        {{-- Cash On Delivery --}}
                        <div class="col-md-6">
                            <form action="{{ route('checkout.process', ['shipping_id' => $shipping->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="payment_method" value="cod">
                                <button type="submit" class="btn btn-outline-success w-100 py-3 fw-bold rounded-pill h-100">
                                    💰 Cash On Delivery
                                </button>
                            </form>
                        </div>

                        {{-- Stripe --}}
                        <div class="col-md-6">
                            <form action="{{ route('stripe.checkout') }}" method="POST">
                                @csrf
                                <input type="hidden" name="shipping_id" value="{{ $shipping->id }}">
                                <button type="submit" class="btn btn-outline-primary w-100 py-3 fw-bold rounded-pill h-100">
                                    💳 Pay with Stripe
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Total Amount --}}
                    <div class="card border-0 bg-dark text-white p-4 rounded-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h4 mb-0 fw-bold">Total Payable:</span>
                            <span class="h3 mb-0 fw-bold text-warning">₹{{ number_format($totalAmount) }}</span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection