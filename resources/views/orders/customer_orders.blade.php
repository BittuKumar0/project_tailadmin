@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <i class="fas fa-box-open me-2 text-success"></i>My Orders
            </h2>
            <p class="text-muted small">Track and manage your recent orders</p>
        </div>

        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}" class="text-success text-decoration-none">Home</a>
                </li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </nav>
    </div>

    <!-- Table Card -->
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden bg-white">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">

                <thead class="bg-light">
                    <tr class="text-secondary">
                        <th class="ps-4 py-3">Order ID</th>
                        <th>Product</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Payment</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-4">Date</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-primary">
                                #{{ $order->order_id }}
                            </span>
                        </td>

                        <td>
                            <div>
                                <div class="fw-bold">
                                    {{ \Illuminate\Support\Str::limit($order->product_name, 50) }}
                                </div>
                                <small class="text-muted">
                                    Qty: {{ $order->quantity }}
                                </small>
                            </div>
                        </td>

                        <td class="text-center fw-bold">
                            ₹{{ number_format($order->total, 2) }}
                        </td>

                        <td class="text-center">
                            <span class="badge rounded-pill px-3 
                                {{ $order->payment_method == 'cod' ? 'bg-secondary' : 'bg-primary' }}">
                                {{ strtoupper($order->payment_method) }}
                            </span>
                        </td>

                        <td class="text-center">
                            @if($order->payment_status == 'paid')
                                <span class="badge bg-success-subtle text-success border px-3 py-2">
                                    ✔ Paid
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border px-3 py-2">
                                    ⏳ Pending
                                </span>
                            @endif
                        </td>

                        <td class="text-end pe-4 text-muted small">
                            {{ $order->created_at->format('d M, Y') }}
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <h5 class="text-muted">No orders found</h5>
                            <a href="{{ url('/') }}" class="btn btn-success mt-3">
                                Start Shopping
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>

</div>

<style>
.bg-success-subtle { background: #d1e7dd; }
.bg-warning-subtle { background: #fff3cd; }

.table-hover tbody tr:hover {
    background-color: #f8fafc;
}

.pagination .page-item.active .page-link {
    background-color: #198754;
    border-color: #198754;
}

.pagination .page-link {
    color: #198754;
}
</style>

@endsection