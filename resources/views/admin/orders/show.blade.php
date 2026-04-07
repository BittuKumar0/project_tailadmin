@extends('layouts.admin')

@section('page-title', 'Order Details')

@section('content')
<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item small"><a href="{{ route('admin.orders.index') }}" class="text-decoration-none text-muted">Orders</a></li>
                    <li class="breadcrumb-item active small fw-bold" aria-current="page">Details</li>
                </ol>
            </nav>
            <h4 class="fw-black text-slate-800 mb-0">Order #ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</h4>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-light border rounded-pill px-3 fw-bold text-xs shadow-sm">
                <i class="fas fa-print me-1"></i> Print Invoice
            </button>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-emerald-500 text-blue rounded-pill px-4 fw-bold shadow-sm border-0 text-xs">
                <i class="fas fa-arrow-left me-1"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4 p-4 bg-white">
                <h6 class="fw-black text-slate-800 mb-4 text-uppercase text-[10px] tracking-wider">Order Journey</h6>
                <div class="d-flex justify-content-between position-relative mb-2">
                   @php
    // Define the workflow statuses
    $statuses = ['pending', 'processing', 'shipped', 'delivered'];

    // Make sure order status is lowercase
    $orderStatus = strtolower($order->status ?? 'pending');

    // Find current index safely
    $currentIdx = array_search($orderStatus, $statuses);

    // If status not found, set to -1 (none completed)
    if ($currentIdx === false) {
        $currentIdx = -1;
    }
@endphp
                    @foreach($statuses as $index => $status)
                        <div class="text-center" style="flex: 1; z-index: 2;">
                            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2 shadow-sm 
                                {{ $index <= $currentIdx ? 'bg-emerald-500 text-white' : 'bg-light text-muted border' }}" 
                                style="width: 35px; height: 35px; font-size: 12px;">
                                <i class="fas {{ $index < $currentIdx ? 'fa-check' : ($index == $currentIdx ? 'fa-sync-alt fa-spin' : 'fa-circle') }}"></i>
                            </div>
                            <p class="mb-0 text-[10px] fw-black text-uppercase {{ $index <= $currentIdx ? 'text-slate-800' : 'text-muted' }}">{{ $status }}</p>
                        </div>
                    @endforeach
                    <div class="position-absolute top-0 mt-3 start-0 w-100 bg-light" style="height: 4px; z-index: 1;">
                        <div class="bg-emerald-500 h-100 transition-all" style="width: {{ ($currentIdx / (count($statuses)-1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-white border-0 py-3 px-4">
                    <h6 class="fw-black text-slate-800 mb-0">Items Summary</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="text-muted text-[10px] uppercase fw-bold">
                                <th class="px-4">Product Details</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th class="text-end px-4">Total</th>
                            </tr>
                        </thead>
                     <tbody>
    <tr>
        <td class="px-4 py-3">
            <div class="d-flex align-items-center">
                <div class="bg-light rounded-3 me-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                    <i class="fas fa-box text-muted"></i>
                </div>
                <div>
                    <span class="d-block fw-bold text-slate-700 small">{{ $order->product_name ?? 'No Product' }}</span>
                    <span class="text-[9px] text-muted tracking-tighter">SKU: {{ $order->sku ?? 'N/A' }}</span>
                </div>
            </div>
        </td>
        <td class="small text-slate-600">x1</td>
        <td class="small text-slate-600">₹{{ number_format($order->product_price, 2) }}</td>
        <td class="text-end px-4 fw-black text-slate-800 small">
    ₹{{ number_format($order->product_price * ($order->quantity ?? 1), 2) }}
</td>
    </tr>
</tbody>
                        <tfoot class="bg-light-subtle">
                            <tr>
                                <td colspan="3" class="text-end fw-bold text-muted small px-4 py-2">Subtotal:</td>
                              <td class="text-end px-4 py-2 fw-bold small">₹{{ number_format($order->total_price, 2) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-black text-slate-800 px-4 py-3">Grand Total:</td>
                               @php
    $total = ($order->product_price ?? 0) * ($order->quantity ?? 1);
@endphp
<td class="text-end px-4 py-2 fw-bold small">₹{{ number_format($total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden bg-white">
                <div class="p-4 bg-soft-emerald border-bottom border-white">
                    <h6 class="fw-black text-emerald-600 mb-0 text-uppercase text-[10px] tracking-wider">Customer Information</h6>
                </div>
                <div class="p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-white shadow-sm rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; border: 2px solid #fff;">
                            <i class="fas fa-user-circle fs-3 text-slate-400"></i>
                        </div>
                        <div>
                            <p class="mb-0 fw-black text-slate-800">{{ $order->user->name ?? 'Guest Customer' }}</p>
                            <span class="text-muted text-[10px]">{{ $order->user->email ?? 'No Email' }}</span>
                        </div>
                    </div>
                    <hr class="opacity-50">
                    <div class="space-y-3">
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Phone:</span>
                            <span class="small fw-bold text-slate-700">{{ $order->user->phone ?? '+91 XXXXX XXXXX' }}</span>
                        </div>
                        <div class="mt-2">
                            <span class="text-muted small d-block mb-1">Shipping Address:</span>
                            <p class="small text-slate-600 fw-medium bg-light p-2 rounded-3 mb-0 border">
                                {{ $order->address ?? 'No address provided.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="p-4">
                    <h6 class="fw-black text-slate-800 mb-4 text-uppercase text-[10px] tracking-wider">Payment Details</h6>
                    <div class="bg-light p-3 rounded-4 border">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted small">Method:</span>
                            <span class="badge bg-white border text-dark text-[9px] px-3 py-1 uppercase fw-black">{{ $order->payment_method ?? 'COD' }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted small">Payment Status:</span>
                            <span class="text-{{ strtolower($order->status) == 'delivered' ? 'success' : 'warning' }} fw-black small text-uppercase" style="font-size: 10px;">
                                <i class="fas fa-circle me-1" style="font-size: 6px; vertical-align: middle;"></i>
                                {{ $order->payment_status ?? 'Pending' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-black { font-weight: 800; }
    .text-[10px] { font-size: 10px; }
    .text-[9px] { font-size: 9px; }
    .text-xs { font-size: 11px; }
    .bg-emerald-500 { background-color: #10b981; }
    .text-emerald-600 { color: #059669; }
    .bg-soft-emerald { background-color: #ecfdf5; }
    .text-slate-800 { color: #1e293b; }
    .text-slate-700 { color: #334155; }
    .transition-all { transition: 0.3s ease-in-out; }
    .tracking-tighter { letter-spacing: -0.05em; }
</style>
@endsection