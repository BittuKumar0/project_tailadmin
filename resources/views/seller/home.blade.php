@extends('layouts.app')

@section('title', 'Seller Dashboard - EasyFarming')

@push('styles')
<style>
    .stat-card { 
        background: linear-gradient(135deg, #28a745, #20c997);
        transition: all 0.3s ease;
        height: 120px;
        border: none;
    }
    .stat-card:hover { transform: translateY(-5px); }
    .seller-card { border-left: 4px solid #28a745; }
    .chart-container { height: 320px; }
    .activity-img { width: 40px; height: 40px; object-fit: cover; border-radius: 8px; }
</style>
@endpush

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-tachometer-alt text-success me-2"></i>
        Seller Dashboard
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="{{ route('seller.products.create') }}" class="btn btn-success btn-sm">
            <i class="fas fa-plus me-1"></i>Add Product
        </a>
    </div>
</div>

<!-- Stats Cards (No changes needed - icons work fine) -->
<div class="row g-4 mb-5">
    <!-- Your existing 4 stat cards remain exactly the same -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
        <div class="card stat-card text-white shadow-lg">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 bg-white bg-opacity-20 p-3 rounded-circle me-3">
                        <i class="fas fa-rupee-sign fa-2x"></i>
                    </div>
                    <div>
                        <h3 class="mb-0 fw-bold">₹2,45,680</h3>
                        <small class="opacity-75">Total Revenue</small>
                        <small class="badge bg-success ms-2">+12.5%</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Other 3 stat cards remain same... -->
</div>

<div class="row g-4">
    <!-- Sales Chart (Working fine) -->
    <div class="col-xl-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title mb-0 d-flex align-items-center">
                    <i class="fas fa-chart-line text-success me-2"></i>Sales Analytics
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="chart-container">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions (No changes needed) -->
    <div class="col-xl-4">
        <!-- Your existing quick actions remain same -->
    </div>
</div>

<!-- Recent Activity WITH IMAGES -->
<div class="row g-4 mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-clock text-warning me-2"></i>Recent Activity
                </h5>
                <a href="#" class="btn btn-outline-success btn-sm">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Activity</th>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="badge bg-success me-2">New Order</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('images/customers/customer1.jpg') }}" alt="Rajesh" class="activity-img me-2">
                                        Rajesh Kumar
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('images/products/aries-agripro.jpg') }}" alt="Aries" class="activity-img me-2">
                                        Aries Agripro
                                    </div>
                                </td>
                                <td>₹578</td>
                                <td><span class="badge bg-success">Completed</span></td>
                                <td>2h ago</td>
                            </tr>
                            <tr>
                                <td><span class="badge bg-primary me-2">Shipped</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('images/customers/customer2.jpg') }}" alt="Priya" class="activity-img me-2">
                                        Priya Sharma
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('images/products/fantac-plus.jpg') }}" alt="Fantac" class="activity-img me-2">
                                        Fantac Plus
                                    </div>
                                </td>
                                <td>₹656</td>
                                <td><span class="badge bg-warning">Shipped</span></td>
                                <td>1d ago</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('salesChart')?.getContext('2d');
if (ctx) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Sales ₹',
                data: [12000, 19000, 15000, 28000, 22000, 32000],
                borderColor: '#28a745',
                backgroundColor: 'rgba(40, 167, 69, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#28a745'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                x: { grid: { display: false } }
            }
        }
    });
}
</script>
@endpush
