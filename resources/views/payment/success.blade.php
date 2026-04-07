@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-5">
                    <div class="mb-4">
                        <div class="checkmark-circle mx-auto mb-3">
                            <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="40" cy="40" r="35" stroke="#28a745" stroke-width="5" fill="none" />
                                <path d="M25 40 L35 50 L55 30" stroke="#28a745" stroke-width="6" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h1 class="display-5 fw-bold text-success mb-1">Payment Successful!</h1>
                        <p class="lead text-muted">Thank you for your purchase, {{ auth()->user()->name }}!</p>
                    </div>

                    <div class="order-summary bg-light p-4 rounded-4 mb-4 text-start border-start border-success border-4">
                        <h5 class="fw-bold mb-3"><i class="fas fa-receipt text-primary me-2"></i>Order Details</h5>
                        <div class="row">
                            <div class="col-sm-4 text-muted">Items Purchased:</div>
                            <div class="col-sm-8 fw-bold">
                                {{-- Robust check for items --}}
                                @if(isset($order) && $order->items)
                                    @foreach($order->items as $item)
                                        <div>{{ $item->product->name ?? 'Product' }} (x{{ $item->quantity }})</div>
                                    @endforeach
                                @else
                                    <div>Order items details processed.</div>
                                @endif
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4 text-muted">Amount Paid:</div>
                            <div class="col-sm-8 text-success fw-bold">
                                ₹{{ number_format($order->amount ?? $totalAmount ?? 0, 2) }}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-muted">Transaction ID:</div>
                            <div class="col-sm-8 text-truncate text-primary small">
                                {{ $order->transaction_id ?? 'STRIPE_'.Str::random(10) }}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-4 text-muted">Date:</div>
                            <div class="col-sm-8">
                                {{ isset($order) ? $order->created_at->format('M d, Y h:i A') : now()->format('M d, Y h:i A') }}
                            </div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm bg-aliceblue">
                                <div class="card-body p-3">
                                    <i class="fas fa-envelope text-info mb-2 fs-4"></i>
                                    <h6>Email Confirmation</h6>
                                    <p class="text-muted small mb-0">Receipt sent to<br><strong>{{ auth()->user()->email }}</strong></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100 border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <i class="fas fa-file-invoice text-warning mb-2 fs-4"></i>
                                    <h6>Need an Invoice?</h6>
                                    @if(isset($order))
                                        <a href="{{ route('invoice.pdf', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill mt-1">Download PDF</a>
                                    @else
                                        <span class="badge bg-secondary">Available in My Orders</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 d-grid d-sm-flex justify-content-sm-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-primary btn-lg px-5 rounded-pill shadow">
                            <i class="fas fa-home me-2"></i>Home
                        </a>
                        <a href="{{ url('/shop') }}" class="btn btn-outline-secondary btn-lg px-5 rounded-pill">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-aliceblue { background-color: #f0f8ff; }
    .checkmark-circle { width: 80px; height: 80px; }
    .order-summary { border-radius: 15px; }
    .display-5 { letter-spacing: -1px; }
</style>
@endsection