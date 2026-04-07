@extends('layouts.app')

@section('title', 'Seller Orders')

@section('content')
<div class="container-fluid py-4 px-lg-5">
    
    {{-- Top Header Section --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-3">
        <div>
            <h1 class="h3 fw-bold text-dark mb-1">
                <i class="fas fa-shopping-bag text-success me-2"></i>Orders Dashboard
            </h1>
            <p class="text-muted small mb-0">Manage your sales, track shipments and customer fulfillment</p>
        </div>
        
        {{-- Quick Stats Card --}}
        <div class="bg-white border shadow-sm rounded-4 px-4 py-3 d-flex align-items-center">
            <div class="bg-success-soft rounded-circle p-2 me-3">
                <i class="fas fa-chart-line text-success fs-4"></i>
            </div>
            <div>
                <p class="text-muted small mb-0 fw-bold uppercase">Total Orders</p>
                <p class="h4 fw-black text-dark mb-0 font-mono">{{ $orders->total() }}</p>
            </div>
        </div>
    </div>

    {{-- Main Table Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0 custom-table">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-4 text-xs font-bold text-uppercase text-muted border-0">Order ID</th>
                        <th class="py-4 text-xs font-bold text-uppercase text-muted border-0">Customer Details</th>
                        <th class="py-4 text-xs font-bold text-uppercase text-muted border-0">Items</th>
                        <th class="py-4 text-xs font-bold text-uppercase text-muted border-0">Amount</th>
                        <th class="py-4 text-xs font-bold text-uppercase text-muted border-0">Status</th>
                        <th class="px-4 py-4 text-xs font-bold text-uppercase text-muted border-0 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($orders as $order)
                        <tr class="transition-all">
                            <td class="px-4">
                                <span class="badge bg-blue-soft text-primary rounded-3 px-3 py-2 font-mono fw-bold">
                                    #{{ $order->order_id }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark mb-0">{{ $order->name ?? 'Guest' }}</div>
                                <div class="text-muted small d-flex align-items-center mt-1">
                                    <i class="far fa-envelope me-1 opacity-50"></i> {{ $order->email }}
                                </div>
                                <div class="text-success small fw-bold mt-1">
                                    <i class="fas fa-phone-alt me-1 opacity-50"></i> {{ $order->phone }}
                                </div>
                            </td>
                            <td>
                                <div class="text-dark fw-semibold text-truncate mb-0" style="max-width: 180px;" title="{{ $order->product_name }}">
                                    {{ $order->product_name }}
                                </div>
                                <div class="badge bg-light text-muted fw-normal border mt-1">
                                    Qty: {{ $order->quantity }}
                                </div>
                            </td>
                            <td>
                                <div class="fw-black text-dark h6 mb-0">
                                    ₹{{ number_format($order->total, 2) }}
                                </div>
                                <div class="text-uppercase text-muted fw-bold" style="font-size: 10px;">
                                    {{ $order->payment_method }}
                                </div>
                            </td>
                            <td>
                                @php
                                    $status = strtolower($order->payment_status ?? $order->status);
                                    $class = match($status) {
                                        'paid', 'delivered' => 'bg-success-soft text-success border-success-subtle',
                                        'pending', 'ordered' => 'bg-warning-soft text-warning border-warning-subtle',
                                        'cancelled' => 'bg-danger-soft text-danger border-danger-subtle',
                                        default => 'bg-secondary-soft text-secondary border-secondary-subtle',
                                    };
                                @endphp
                                <span class="badge {{ $class }} border rounded-pill px-3 py-2 fw-bold text-uppercase" style="font-size: 10px;">
                                    <i class="fas fa-circle me-1" style="font-size: 6px;"></i> {{ $status }}
                                </span>
                            </td>
                            <td class="px-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-dark btn-sm rounded-pill px-3 fw-bold shadow-sm hover-up" style="font-size: 11px;">
                                        <i class="far fa-eye me-1"></i> VIEW
                                    </a>
                                 <a href="{{ route('invoice.pdf', ['id' => $order->order_id]) }}" class="btn btn-outline-secondary btn-sm rounded-circle shadow-sm">
    <i class="fas fa-print"></i>
</a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5">
                                <div class="py-4">
                                    <i class="fas fa-receipt fa-3x text-muted opacity-25 mb-3 d-block"></i>
                                    <p class="text-muted fw-bold italic mb-0">No orders found in your records.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Wrapper --}}
        @if($orders->hasPages())
            <div class="card-footer bg-white border-0 py-4 px-4 shadow-sm border-top">
                <div class="pagination-wrapper">
                    {{ $orders->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

<style>
    /* Utility Colors for Soft Badges */
    .bg-success-soft { background-color: #e8f5e9 !important; color: #2e7d32; }
    .bg-blue-soft { background-color: #e3f2fd !important; color: #1565c0; }
    .bg-warning-soft { background-color: #fff8e1 !important; color: #f57f17; }
    .bg-danger-soft { background-color: #ffebee !important; color: #c62828; }
    .bg-secondary-soft { background-color: #f5f5f5 !important; color: #757575; }

    .rounded-4 { border-radius: 1rem !important; }
    .fw-black { font-weight: 900 !important; }
    .font-mono { font-family: 'Courier New', Courier, monospace; }
    
    .custom-table thead th {
        letter-spacing: 0.05rem;
        font-size: 0.7rem !important;
    }

    .custom-table tbody tr {
        transition: all 0.3s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #f8fafc !important;
        transform: translateY(-1px);
    }

    .hover-up:hover {
        transform: translateY(-2px);
        transition: transform 0.2s;
    }

    /* Laravel Pagination Cleaner */
    .pagination-wrapper nav svg {
        width: 1.25rem !important;
        height: 1.25rem !important;
        display: inline-block;
    }
    
    .pagination-wrapper nav div:first-child { display: none; }
</style>
@endsection