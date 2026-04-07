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
</style>
@endpush

@section('content')
<!-- Seller Dashboard Stats -->
<div class="row g-4 mb-5">
    <!-- Total Sales -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card text-white shadow-lg border-0">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-rupee-sign fa-2x opacity-75"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="card-title mb-0">₹2,45,680</h5>
                    <small class="opacity-75">Total Sales</small>
                </div>
                <div class="trend-badge bg-success bg-opacity-25 text-success px-2 py-1 rounded-pill small">
                    +12.5%
                </div>
            </div>
        </div>
    </div>

    <!-- Total Orders -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card text-white shadow-lg border-0" style="background: linear-gradient(135deg, #dc3545, #fd7e14);">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-shopping-bag fa-2x opacity-75"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="card-title mb-0">1,247</h5>
                    <small class="opacity-75">Total Orders</small>
                </div>
                <div class="trend-badge bg-danger bg-opacity-25 text-danger px-2 py-1 rounded-pill small">
                    +8.3%
                </div>
            </div>
        </div>
    </div>

    <!-- Total Products -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card text-white shadow-lg border-0" style="background: linear-gradient(135deg, #0d6efd, #6610f2);">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-box fa-2x opacity-75"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="card-title mb-0">89</h5>
                    <small class="opacity-75">Active Products</small>
                </div>
                <div class="trend-badge bg-primary bg-opacity-25 text-primary px-2 py-1 rounded-pill small">
                    +3
                </div>
            </div>
        </div>
    </div>

    <!-- Total Customers -->
    <div class="col-xl-3 col-md-6">
        <div class="card stat-card text-white shadow-lg border-0" style="background: linear-gradient(135deg, #198754, #20c997);">
            <div class="card-body d-flex align-items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-users fa-2x opacity-75"></i>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h5 class="card-title mb-0">324</h5>
                    <small class="opacity-75">Customers</small>
                </div>
                <div class="trend-badge bg-success bg-opacity-25 text-success px-2 py-1 rounded-pill small">
                    +15
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Dashboard Content -->
<div class="row g-4">
    <!-- Quick Actions -->
    <div class="col-lg-4">
        <div class="card seller-card shadow-sm h-100">
            <div class="card-header bg-light border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-bolt text-success me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('seller.products.create') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-plus me-2"></i>Add New Product
                    </a>
                    <a href="{{ route('seller.products.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-box me-2"></i>Manage Products
                    </a>
                    <a href="{{ route('seller.orders.index') }}" class="btn btn-outline-warning">
                        <i class="fas fa-shopping-bag me-2"></i>View Orders
                    </a>
                    <a href="{{ route('seller.customers.index') }}" class="btn btn-outline-info">
                        <i class="fas fa-users me-2"></i>Customers
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="col-lg-8">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-light border-0 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-chart-line text-success me-2"></i>Sales Overview
                </h5>
                <div class="btn-group btn-group-sm" role="group">
                    <button class="btn btn-outline-secondary active" data-period="7">7D</button>
                    <button class="btn btn-outline-secondary" data-period="30">30D</button>
                    <button class="btn btn-outline-secondary" data-period="90">90D</button>
                </div>
            </div>
            <div class="card-body chart-container">
                <canvas id="salesChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders & Top Products -->
<div class="row g-4 mt-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="card recent-order shadow-sm">
            <div class="card-header bg-light border-0">
                <h5 class="card-title mb-0 d-flex align-items-center">
                    <i class="fas fa-clock text-warning me-2"></i>Recent Orders
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-primary">#FK1245</span></td>
                                <td>Rajesh K.</td>
                                <td>Aries Agripro</td>
                                <td>₹578</td>
                                <td>
                                    <span class="badge bg-success">Delivered</span>
                                </td>
                                <td>2 hours ago</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-primary">#FK1244</span></td>
                                <td>Priya S.</td>
                                <td>Fantac Plus</td>
                                <td>₹656</td>
                                <td>
                                    <span class="badge bg-warning">Shipped</span>
                                </td>
                                <td>1 day ago</td>
                            </tr>
                            <!-- More rows... -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-light border-0">
                <a href="{{ route('seller.orders.index') }}" class="btn btn-outline-success btn-sm">
                    <i class="fas fa-eye me-1"></i>View All Orders
                </a>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="col-lg-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-light border-0">
                <h5 class="card-title mb-0">
                    <i class="fas fa-trophy text-warning me-2"></i>Top Products
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="list-group-item px-0 border-end-0">
                        <div class="row align-items-center">
                            <div class="col-2">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                    1
                                </div>
                            </div>
                            <div class="col-7">
                                <h6 class="mb-1">Aries Agripro</h6>
                                <small class="text-muted">127 sold</small>
                            </div>
                            <div class="col-3 text-end">
                                <strong>₹578</strong>
                            </div>
                        </div>
                    </div>
                    <!-- More top products... -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Sales Chart
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales',
                data: [12000, 19000, 15000, 28000, 22000, 24500],
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush
