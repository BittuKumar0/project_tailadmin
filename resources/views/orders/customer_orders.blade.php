@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">
            <i class="fas fa-box-open me-2 text-success"></i>My Orders
        </h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </nav>
    </div>

    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr class="text-secondary">
                        <th class="ps-4 py-3">Order ID</th>
                        <th class="py-3">Product Details</th>
                        <th class="py-3 text-center">Amount</th>
                        <th class="py-3 text-center">Payment</th>
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 pe-4 text-end">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold text-primary">#{{ $order['order_id'] }}</span>
                        </td>
                        <td>
                            <div class="d-flex flex-column">
                                <span class="fw-bold text-dark">{{ Str::limit($order['product_name'], 50) }}</span>
                                <small class="text-muted">Quantity: {{ $order['quantity'] }}</small>
                            </div>
                        </td>
                        <td class="text-center fw-bold">
                            ₹{{ number_format($order['total'], 0) }}
                        </td>
                        <td class="text-center">
                            <span class="badge rounded-pill px-3 {{ $order['payment_method'] == 'cod' ? 'bg-secondary' : 'bg-primary' }}">
                                {{ strtoupper($order['payment_method']) }}
                            </span>
                        </td>
                        <td class="text-center">
                            @if($order['payment_status'] == 'paid')
                                <span class="badge bg-success-subtle text-success border border-success px-3">
                                    <i class="fas fa-check-circle me-1"></i>Paid
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning px-3">
                                    <i class="fas fa-clock me-1"></i>Pending
                                </span>
                            @endif
                        </td>
                        <td class="pe-4 text-end text-muted">
                            {{ \Carbon\Carbon::parse($order['created_at'])->format('d M, Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="No Orders" style="width: 80px; opacity: 0.3;">
                            <p class="mt-3 text-muted">Aapne abhi tak koi order nahi kiya hai.</p>
                            <a href="{{ url('/') }}" class="btn btn-success rounded-pill px-4">Start Shopping</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
    </div>

<style>
    .bg-success-subtle { background-color: #d1e7dd !important; }
    .bg-warning-subtle { background-color: #fff3cd !important; }
    .table thead th { font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.5px; }
    .rounded-4 { border-radius: 1rem !important; }
    
    /* Pagination Link Color Fix */
    .pagination .page-item.active .page-link {
        background-color: #198754;
        border-color: #198754;
    }
    .pagination .page-link {
        color: #198754;
    }
</style>
@endsection