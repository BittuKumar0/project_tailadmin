@extends('layouts.admin')

@section('page-title', 'Order Details')

@section('content')
<div class="container-fluid py-4">
    
    {{-- Header Section --}}
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

        <div class="d-flex gap-2 align-items-center">
            {{-- Status Update Dropdown (Admin power to change status) --}}
            <div class="dropdown">
                <button class="btn btn-white border rounded-pill px-3 fw-bold text-xs shadow-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Status: <span class="text-emerald-600">{{ ucfirst($order->status) }}</span>
                </button>
                <ul class="dropdown-menu shadow border-0 rounded-3 text-xs">
                    <li><a class="dropdown-item" href="#" onclick="updateStatus('processing')">Mark Processing</a></li>
                    <li><a class="dropdown-item fw-bold text-primary" href="#" onclick="updateStatus('shipped')">Mark Shipped (Gen OTP)</a></li>
                </ul>
            </div>

            {{-- Delivery OTP Display (Only visible when status is shipped) --}}
            @if(strtolower($order->status) == 'shipped')
                @if($order->delivery_otp)
                    <div class="bg-primary text-white px-3 py-1 rounded-pill d-flex align-items-center shadow-sm">
                        <small class="fw-bold me-2" style="font-size: 10px;">OTP:</small>
                        <span class="fw-black tracking-widest">{{ $order->delivery_otp }}</span>
                    </div>
                @endif

                <button class="btn btn-success rounded-pill px-4 fw-bold shadow-sm border-0 text-xs" data-bs-toggle="modal" data-bs-target="#otpModal">
                    <i class="fas fa-check-circle me-1"></i> Confirm Delivery
                </button>
            @endif

            <a href="{{ route('admin.orders.index') }}" class="btn btn-light border rounded-pill px-4 fw-bold shadow-sm text-xs">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    {{-- Hidden form for status update --}}
    <form id="statusForm" action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" id="statusInput">
    </form>

    <div class="row g-4">
        {{-- Left Column: Journey & Items --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4 p-4 bg-white">
                <h6 class="fw-black text-slate-800 mb-4 text-uppercase text-[10px] tracking-wider">Order Journey</h6>
                <div class="d-flex justify-content-between position-relative mb-2">
                   @php
                        $statuses = ['pending', 'processing', 'shipped', 'delivered'];
                        $orderStatus = strtolower($order->status ?? 'pending');
                        $currentIdx = array_search($orderStatus, $statuses);
                        if ($currentIdx === false) { $currentIdx = -1; }
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
                        <div class="bg-emerald-500 h-100 transition-all" style="width: {{ $currentIdx >= 0 ? ($currentIdx / (count($statuses)-1)) * 100 : 0 }}%"></div>
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
                                            <span class="d-block fw-bold text-slate-700 small">{{ $order->product_name ?? 'Aries Agripro Micronutrient' }}</span>
                                            <span class="text-[9px] text-muted">SKU: {{ $order->sku ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="small text-slate-600">x{{ $order->quantity ?? 1 }}</td>
                                <td class="small text-slate-600">₹{{ number_format($order->product_price, 2) }}</td>
                                <td class="text-end px-4 fw-black text-slate-800 small">₹{{ number_format($order->product_price * ($order->quantity ?? 1), 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

{{-- OTP Modal --}}
<div class="modal fade" id="otpModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-body text-center p-4">
                <div class="mb-3">
                    <i class="fas fa-lock text-emerald-500 fs-1"></i>
                </div>
                <h6 class="fw-black text-slate-800">Verify Delivery</h6>
                <p class="text-muted small mb-4">Enter the 4-digit code provided by the customer.</p>
                <form id="otpVerifyForm">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <input type="text" name="otp" class="form-control form-control-lg text-center fw-black tracking-widest border-2 mb-3" maxlength="4" placeholder="0000" required>
                    <button type="submit" class="btn btn-emerald-500 text-white w-100 fw-bold rounded-pill py-2 shadow-sm border-0">Verify & Complete</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
    function updateStatus(val) {
        document.getElementById('statusInput').value = val;
        document.getElementById('statusForm').submit();
    }

    document.getElementById('otpVerifyForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const btn = this.querySelector('button');
        btn.disabled = true;
        btn.innerText = 'Verifying...';

        fetch("{{ route('admin.orders.verify-otp') }}", {
            method: "POST",
            body: new FormData(this),
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) { window.location.reload(); }
            else { alert(data.error || 'Invalid OTP'); btn.disabled = false; btn.innerText = 'Verify & Complete'; }
        });
    });

    // Leaflet Map Init
    document.addEventListener('DOMContentLoaded', function() {
        var map = L.map('map').setView([30.7333, 76.7794], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        L.marker([30.7333, 76.7794]).addTo(map).bindPopup('Order Location').openPopup();
    });
</script>

<style>
    .fw-black { font-weight: 800; }
    .text-[10px] { font-size: 10px; }
    .bg-emerald-500 { background-color: #10b981; }
    .bg-soft-emerald { background-color: #ecfdf5; }
    .text-emerald-600 { color: #059669; }
    .tracking-widest { letter-spacing: 0.3em; }
    .animate-pulse { animation: pulse 2s infinite; }
    @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }
</style>
@endsection