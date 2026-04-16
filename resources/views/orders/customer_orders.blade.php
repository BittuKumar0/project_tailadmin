@extends('layouts.app')
@section('title', 'My Orders - EasyFarming')

@push('styles')
<style>
    .order-table-card { border-radius: 15px; border: none; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; }
    .table thead { background-color: #f8f9fa; }
    .order-id-badge { background-color: #e9ecef; color: #495057; font-weight: 700; padding: 5px 10px; border-radius: 6px; }
    .btn-track { background-color: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; font-size: 0.75rem; transition: 0.3s; }
    .btn-track:hover { background-color: #2e7d32; color: white; }
    .status-badge { font-size: 0.7rem; padding: 5px 12px; border-radius: 50px; text-transform: uppercase; font-weight: 700; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4 px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark">My Orders</h3>
        <span class="badge bg-success px-3 py-2 rounded-pill">Total: {{ $orders->total() }}</span>
    </div>

    <div class="card order-table-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">Order ID</th>
                            <th>Product</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="pe-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="ps-4">
                                    <span class="order-id-badge">#{{ $order->order_id }}</span>
                                </td>
                                <td>
                                    <div class="fw-bold">{{ $order->product_name }}</div>
                                    <small class="text-muted">Qty: {{ $order->quantity }}</small>
                                </td>
                                <td><span class="fw-bold text-success">₹{{ number_format($order->total, 2) }}</span></td>
                                <td>
                                    <span class="badge rounded-pill {{ strtolower($order->payment_status) == 'paid' ? 'bg-success-subtle text-success' : 'bg-warning-subtle text-warning' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $s = strtolower($order->status);
                                        $class = $s == 'pending' ? 'bg-secondary' : ($s == 'shipped' ? 'bg-primary' : ($s == 'delivered' ? 'bg-success' : 'bg-info'));
                                    @endphp
                                    <span class="badge status-badge {{ $class }}">{{ $order->status }}</span>
                                </td>
                                <td>
                                    <div class="small">{{ $order->created_at->format('d M, Y') }}</div>
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        {{-- View Details --}}
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-eye me-1"></i> 
                                        </a>

                                        {{-- Track Button --}}
                                        <a href="{{ route('orders.track', $order->id) }}" class="btn btn-sm btn-track rounded-pill px-3 fw-bold shadow-sm">
                                            <i class="fas fa-truck-fast me-1"></i> Track
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection