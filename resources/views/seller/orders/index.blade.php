@extends('layouts.app') {{-- Ya jo bhi aapka layout file hai --}}

@section('content')
<div class="container-fluid py-4">
    <h4 class="fw-black text-slate-800 mb-4">My Sales Orders</h4>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table align-middle mb-0 table-hover">
                <thead class="bg-light">
                    <tr class="text-muted small text-uppercase fw-bold">
                        <th class="px-4 py-3">Order ID</th>
                        <th>Customer</th>
                        <th>Product Details</th>
                        <th>Status</th>
                        <th class="text-end px-4">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="hover-row">
                        <td class="px-4 fw-bold text-primary">#{{ $order->order_id }}</td>
                        <td>
                            <div class="fw-bold small">{{ $order->user->name ?? $order->name }}</div>
                            <div class="text-muted text-[9px]">{{ $order->email }}</div>
                        </td>
                        <td>
                            {{-- Agar aap single product store kar rahe hain --}}
                            <span class="badge bg-soft-success text-success rounded-pill px-2">
                                {{ $order->product_name }} (x{{ $order->quantity }})
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-soft-info text-info border border-info-subtle rounded-pill px-3 py-2 text-[9px] text-uppercase">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="text-end px-4">
                          <a href="{{ route('seller.orders.show', $order->id) }}" 
   class="btn btn-sm btn-light rounded-pill px-3 border shadow-sm text-[10px] fw-bold">
    View Details
</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">No orders received yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection