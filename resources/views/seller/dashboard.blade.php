@extends('layouts.app')

@section('title', 'Seller Dashboard - EasyFarming')

@push('styles')
<style>
    .stat-card { 
        background: linear-gradient(135deg, #28a745, #20c997);
        transition: all 0.3s ease;
        height: 120px;
    }
    .stat-card:hover { transform: translateY(-5px); }
    .seller-card { border-left: 4px solid #28a745; }
    .recent-order { min-height: 400px; }
    .chart-container { height: 300px; }
    .notification-list { max-height: 300px; overflow-y: auto; }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

    <div class="row g-4 mb-4">
        @php
$notifications = auth()->user()->notifications()->latest()->take(2)->get();
@endphp
  <h5>🔔 New Orders</h5>

@if($notifications->count() > 0)
    <ul class="list-group mb-4">
        @foreach($notifications as $notification)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                
                <div>
                    <strong>{{ $notification->data['message'] }}</strong><br>
                    
                    <small class="text-muted">
                        {{ $notification->created_at->diffForHumans() }}
                    </small>
                </div>

                <div>
                    <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-primary">
                        View
                    </a>

                    <a href="{{ route('notification.read', $notification->id) }}" 
                       class="btn btn-sm btn-success">
                        Mark Read
                    </a>


                    
                </div>

            </li>
        @endforeach
    </ul>
@else
    <p>No new notifications</p>
@endif

    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card stat-card text-white shadow-sm border-0">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0"><i class="fas fa-rupee-sign fa-2x opacity-75"></i></div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="card-title mb-0">₹{{ number_format($data['total_sales'], 2) }}</h5>
                        <small class="opacity-75">Total Revenue</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card text-white shadow-sm border-0" style="background: linear-gradient(135deg, #dc3545, #fd7e14);">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0"><i class="fas fa-shopping-bag fa-2x opacity-75"></i></div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="card-title mb-0">{{ $data['total_orders'] }}</h5>
                        <small class="opacity-75">Orders Received</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card text-white shadow-sm border-0" style="background: linear-gradient(135deg, #0d6efd, #6610f2);">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0"><i class="fas fa-box fa-2x opacity-75"></i></div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="card-title mb-0">{{ $data['total_products'] }}</h5>
                        <small class="opacity-75">Your Products</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card stat-card text-white shadow-sm border-0" style="background: linear-gradient(135deg, #6c757d, #343a40);">
                <div class="card-body d-flex align-items-center">
                    <div class="flex-shrink-0"><i class="fas fa-exclamation-triangle fa-2x opacity-75"></i></div>
                    <div class="flex-grow-1 ms-3">
                        <h5 class="card-title mb-0">Status</h5>
                        <small class="opacity-75">Shop Active</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="card seller-card shadow-sm h-100 border-0">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="card-title mb-0"><i class="fas fa-bolt text-success me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body d-grid gap-3">
                    <a href="{{ route('seller.products.create') }}" class="btn btn-success p-3 rounded-3 text-start">
                        <i class="fas fa-plus-circle me-2"></i> Add New Product
                    </a>
                    <a href="{{ route('seller.products.index') }}" class="btn btn-outline-dark p-3 rounded-3 text-start">
                        <i class="fas fa-boxes me-2"></i> My Inventory
                    </a>
                    <a href="{{ route('seller.orders.index') }}" class="btn btn-outline-dark p-3 rounded-3 text-start">
                        <i class="fas fa-clipboard-list me-2"></i> Manage Orders
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card shadow-sm h-100 border-0">
                <div class="card-header bg-white border-0 py-3 d-flex justify-content-between">
                    <h5 class="card-title mb-0"><i class="fas fa-chart-line text-success me-2"></i>Performance</h5>
                </div>
                <div class="card-body chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

   
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart logic remains same but now it looks cleaner
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
            datasets: [{
                label: 'Revenue',
                data: [500, 1500, 1000, 3000, 2500, 4000, {{ $data['total_sales'] }}],
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.05)',
                tension: 0.4,
                fill: true,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: { y: { beginAtZero: true } }
        }
    });
</script>
@endpush