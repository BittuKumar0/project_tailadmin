@extends('layouts.admin')

@section('page-title', 'Executive Dashboard')

@section('content')
<div class="container-fluid p-0 space-y-6">

    {{-- 1. High-Level Metrics (Floating Cards) --}}
    <div class="row g-4 mb-6">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 border-start border-4 border-emerald-500">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-1">Avg Order Value</p>
                            <h4 class="fw-black mb-0">₹2,450</h4>
                        </div>
                        <div class="bg-emerald-50 text-emerald-600 p-3 rounded-circle"><i class="fas fa-hand-holding-dollar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 border-start border-4 border-blue-500">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-1">Conversion Rate</p>
                            <h4 class="fw-black mb-0">3.24%</h4>
                        </div>
                        <div class="bg-blue-50 text-blue-600 p-3 rounded-circle"><i class="fas fa-chart-pie"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 border-start border-4 border-amber-500">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-1">Customer LTV</p>
                            <h4 class="fw-black mb-0">₹12,800</h4>
                        </div>
                        <div class="bg-amber-50 text-amber-600 p-3 rounded-circle"><i class="fas fa-user-tag"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 border-start border-4 border-rose-500">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small fw-bold text-uppercase mb-1">Cart Abandonment</p>
                            <h4 class="fw-black mb-0 text-danger">42%</h4>
                        </div>
                        <div class="bg-rose-50 text-rose-600 p-3 rounded-circle"><i class="fas fa-shopping-basket"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-6">
        {{-- Left Column: Revenue Forecast & Inventory --}}
        <div class="col-lg-8">
            {{-- Advanced Sales Forecast Card --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-6">
                <div class="card-header bg-white py-4 px-4 border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-black text-slate-800 mb-1">Sales Revenue Forecast</h5>
                        <p class="text-[10px] text-muted mb-0 font-medium uppercase tracking-wider">
                            <span class="text-emerald-500"><i class="fas fa-arrow-trend-up me-1"></i> +14.2%</span> Growth Predicted
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <span class="badge bg-soft-primary text-primary border border-primary-subtle px-3 py-2 rounded-pill small">
                            <i class="fas fa-robot me-1"></i> AI Engine
                        </span>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- Target Achievement Bar --}}
                    <div class="row g-3 mb-4 text-center border-bottom pb-4">
                        <div class="col-4 border-end">
                            <p class="text-[10px] text-muted uppercase fw-black mb-1">Yearly Target</p>
                            <h6 class="fw-black mb-0">₹25.0L</h6>
                        </div>
                        <div class="col-4 border-end">
                            <p class="text-[10px] text-muted uppercase fw-black mb-1">Achieved</p>
                            <h6 class="fw-black mb-0 text-emerald-600">₹14.8L</h6>
                        </div>
                        <div class="col-4">
                            <p class="text-[10px] text-muted uppercase fw-black mb-1">Projected EOFY</p>
                            <h6 class="fw-black mb-0 text-blue-600">₹28.4L</h6>
                        </div>
                    </div>

                    <div style="height: 380px;">
                        <canvas id="salesForecastChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- Inventory Alerts --}}
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-4 border-0">
                    <h6 class="fw-bold mb-0 text-danger"><i class="fas fa-triangle-exclamation me-2"></i>Critical Inventory Alerts</h6>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="bg-light">
                            <tr class="text-muted small">
                                <th class="px-4">Product Name</th>
                                <th>SKU</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th class="text-end px-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-4 fw-bold">Organic NPK Fertilizer</td>
                                <td class="text-muted small">FERT-992</td>
                                <td class="text-danger fw-bold">04 Units</td>
                                <td><span class="badge bg-danger text-white rounded-pill px-3">Critical</span></td>
                                <td class="text-end px-4"><button class="btn btn-sm btn-dark rounded-pill px-3">Restock</button></td>
                            </tr>
                            <tr>
                                <td class="px-4 fw-bold">Tomato Hybrid Seeds</td>
                                <td class="text-muted small">SEED-441</td>
                                <td class="text-warning fw-bold">12 Units</td>
                                <td><span class="badge bg-warning text-dark rounded-pill px-3">Low</span></td>
                                <td class="text-end px-4"><button class="btn btn-sm btn-outline-dark rounded-pill px-3">Restock</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Right Column: Activity & Categories --}}
        <div class="col-lg-4">
            {{-- Live Activity Feed --}}
            <div class="card border-0 shadow-sm rounded-4 mb-6">
                <div class="card-header bg-white py-4 border-0">
                    <h6 class="fw-bold mb-0">Live Activity Feed</h6>
                </div>
                <div class="card-body p-0">
                    <div class="px-4 pb-4">
                        <div class="border-start border-2 border-light ps-4 space-y-6">
                            <div class="position-relative mb-4">
                                <div class="position-absolute top-0 bg-success rounded-circle" style="width:12px; height:12px; left: -31px;"></div>
                                <p class="small mb-0 text-muted">2 mins ago</p>
                                <p class="small fw-bold mb-0">New order from Rajesh (Punjab)</p>
                                <p class="text-success small fw-bold">₹12,400.00</p>
                            </div>
                            <div class="position-relative mb-4">
                                <div class="position-absolute top-0 bg-blue-500 rounded-circle" style="width:12px; height:12px; left: -31px;"></div>
                                <p class="small mb-0 text-muted">15 mins ago</p>
                                <p class="small fw-bold mb-0">Stock updated for "Tractor Oil"</p>
                            </div>
                            <div class="position-relative">
                                <div class="position-absolute top-0 bg-amber-500 rounded-circle" style="width:12px; height:12px; left: -31px;"></div>
                                <p class="small mb-0 text-muted">1 hour ago</p>
                                <p class="small fw-bold mb-0">New Seller: Green Agri Co.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Category Distribution --}}
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <h6 class="fw-bold mb-4">Category Distribution</h6>
                <canvas id="categoryChart" style="max-height: 200px;"></canvas>
                <div class="mt-4 space-y-3">
                    <div class="d-flex justify-content-between small font-bold">
                        <span>Seeds</span> <span class="text-muted">45%</span>
                    </div>
                    <div class="progress mb-2" style="height: 6px; border-radius: 10px;">
                        <div class="progress-bar bg-success" style="width: 45%"></div>
                    </div>
                    <div class="d-flex justify-content-between small font-bold">
                        <span>Tools</span> <span class="text-muted">30%</span>
                    </div>
                    <div class="progress" style="height: 6px; border-radius: 10px;">
                        <div class="progress-bar bg-primary" style="width: 30%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // 1. ADVANCED SALES FORECAST CHART
    const forecastCtx = document.getElementById('salesForecastChart').getContext('2d');
    
    const actualGradient = forecastCtx.createLinearGradient(0, 0, 0, 400);
    actualGradient.addColorStop(0, 'rgba(16, 185, 129, 0.2)');
    actualGradient.addColorStop(1, 'rgba(16, 185, 129, 0)');

    const forecastGradient = forecastCtx.createLinearGradient(0, 0, 0, 400);
    forecastGradient.addColorStop(0, 'rgba(59, 130, 246, 0.1)');
    forecastGradient.addColorStop(1, 'rgba(59, 130, 246, 0)');

    new Chart(forecastCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [
                {
                    label: 'Actual Revenue',
                    data: [42000, 58000, 45000, 82000, 75000, 95000], 
                    borderColor: '#10b981',
                    backgroundColor: actualGradient,
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 6,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#10b981',
                    pointBorderWidth: 3
                },
                {
                    label: 'Forecast (AI)',
                    data: [null, null, null, null, null, 95000, 110000, 128000, 115000, 140000, 155000, 175000], 
                    borderColor: '#3b82f6',
                    backgroundColor: forecastGradient,
                    borderWidth: 3,
                    borderDash: [8, 5], 
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { intersect: false, mode: 'index' },
            plugins: {
                legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, font: { weight: '600' } } }
            },
            scales: {
                y: { grid: { color: '#f1f5f9' }, ticks: { callback: v => '₹' + v/1000 + 'k', font: { weight: '600' } } },
                x: { grid: { display: false }, ticks: { font: { weight: '600' } } }
            }
        }
    });

    // 2. CATEGORY DOUGHNUT
    const catCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(catCtx, {
        type: 'doughnut',
        data: {
            labels: ['Seeds', 'Tools', 'Fertilizer'],
            datasets: [{
                data: [45, 30, 25],
                backgroundColor: ['#10b981', '#3b82f6', '#f59e0b'],
                borderWidth: 0,
                cutout: '80%'
            }]
        },
        options: {
            plugins: { legend: { display: false } }
        }
    });
});
</script>

<style>
    .fw-black { font-weight: 800; }
    .bg-soft-primary { background-color: rgba(59, 130, 246, 0.08); }
    .text-primary { color: #3b82f6 !important; }
    .bg-blue-500 { background-color: #3b82f6; }
    .bg-amber-500 { background-color: #f59e0b; }
    .space-y-6 > * + * { margin-top: 1.5rem; }
    .space-y-3 > * + * { margin-top: 0.75rem; }
</style>
@endsection