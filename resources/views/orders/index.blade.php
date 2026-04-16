@extends('layouts.app')
@section('title', 'All Orders - EasyFarming')

@push('styles')
<style>
    .order-table-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    .table thead {
        background-color: #f8f9fa;
    }
    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: #555;
        border-top: none;
    }
    .order-id-badge {
        background-color: #e9ecef;
        color: #495057;
        font-weight: 700;
        padding: 5px 10px;
        border-radius: 6px;
        text-decoration: none;
    }
    .customer-info p { margin-bottom: 0; line-height: 1.2; }
    .pagination { margin-top: 20px; justify-content: center; }
    .page-item.active .page-link { background-color: #28a745; border-color: #28a745; }
    .page-link { color: #28a745; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark">All Orders Management</h3>
        <span class="badge bg-success px-3 py-2 rounded-pill">Total Orders: {{ $orders->total() }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card order-table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Order ID</th>
                            <th>Product Details</th>
                            <th>Customer & Contact</th>
                
                            <th>Total Amount</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th class="pe-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="ps-4">
                                    <span class="order-id-badge">#{{ $order->order_id }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $order->product_name }}</div>
                                    <small class="text-muted">Qty: {{ $order->quantity }} x ₹{{ number_format($order->price, 2) }}</small>
                                </td>
                                <td>
                                    <div class="customer-info">
                                        <p class="fw-bold mb-0">{{ $order->shippingAddress->full_name ?? $order->name }}</p>
                                        <p class="text-muted small"><i class="fas fa-phone-alt me-1"></i> {{ $order->shippingAddress->phone ?? $order->phone }}</p>
                                        <p class="text-muted small"><i class="fas fa-envelope me-1"></i> {{ $order->shippingAddress->email ?? $order->email }}</p>
                                    </div>
                                </td>
                                <td>
                                    <small class="text-truncate d-inline-block" style="max-width: 150px;" title="{{ $order->shippingAddress->address ?? $order->address }}">
                                        {{ $order->shippingAddress->address ?? $order->address }}, 
                                        {{ $order->shippingAddress->city ?? '' }}, 
                                        {{ $order->shippingAddress->pincode ?? '' }}
                                    </small>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">₹{{ number_format($order->total, 2) }}</span>
                                </td>
                                <td>
                                    @php $pStatus = strtolower($order->payment_status); @endphp
                                    <span class="badge rounded-pill {{ $pStatus == 'paid' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }} px-3">
                                        {{ ucfirst($pStatus) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="small">{{ $order->created_at->format('d M, Y') }}</div>
                                    <div class="text-muted small">{{ $order->created_at->format('H:i A') }}</div>
                                </td>
                                <td class="pe-4 text-center">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-circle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fas fa-box-open fa-3x mb-3 d-block opacity-25"></i>
                                    No orders found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection