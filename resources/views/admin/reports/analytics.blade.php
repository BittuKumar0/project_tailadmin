@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h4 class="fw-black text-slate-800 mb-1">Performance Analytics</h4>
            <p class="text-muted small mb-0 font-medium text-uppercase tracking-wider text-[10px]">Real-time data overview</p>
        </div>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm rounded-pill border-0 shadow-sm px-3 text-xs fw-bold text-muted" style="width: 150px;">
                <option>Last 30 Days</option>
                <option>Last 7 Days</option>
                <option>This Month</option>
            </select>
            <button class="btn btn-emerald-500 text-blue rounded-pill px-3 shadow-sm border-0 text-xs fw-bold">
                <i class="fas fa-sync-alt me-1"></i> Refresh
            </button>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white position-relative overflow-hidden">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-soft-purple text-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="fas fa-globe fs-5"></i>
                    </div>
                    <span class="badge bg-soft-success text-success rounded-pill text-[10px] fw-black">+12%</span>
                </div>
                <p class="text-muted small fw-bold mb-1 text-uppercase tracking-tighter">Website Visits</p>
                <h3 class="fw-black text-slate-800 mb-0">1,200</h3>
                <div class="progress mt-3" style="height: 4px;">
                    <div class="progress-bar bg-purple" style="width: 70%"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-soft-danger text-danger rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="fas fa-percentage fs-5"></i>
                    </div>
                    <span class="badge bg-soft-danger text-danger rounded-pill text-[10px] fw-black">-2.4%</span>
                </div>
                <p class="text-muted small fw-bold mb-1 text-uppercase tracking-tighter">Conversion Rate</p>
                <h3 class="fw-black text-slate-800 mb-0">5.4%</h3>
                <div class="progress mt-3" style="height: 4px;">
                    <div class="progress-bar bg-danger" style="width: 45%"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-soft-emerald text-emerald-600 rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="fas fa-wallet fs-5"></i>
                    </div>
                    <span class="badge bg-soft-success text-success rounded-pill text-[10px] fw-black">+18%</span>
                </div>
                <p class="text-muted small fw-bold mb-1 text-uppercase tracking-tighter">Net Revenue</p>
                <h3 class="fw-black text-slate-800 mb-0">₹84,200</h3>
                <div class="progress mt-3" style="height: 4px;">
                    <div class="progress-bar bg-emerald" style="width: 85%"></div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div class="bg-soft-blue text-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px;">
                        <i class="fas fa-shopping-cart fs-5"></i>
                    </div>
                    <span class="badge bg-soft-blue text-blue rounded-pill text-[10px] fw-black">Steady</span>
                </div>
                <p class="text-muted small fw-bold mb-1 text-uppercase tracking-tighter">Active Orders</p>
                <h3 class="fw-black text-slate-800 mb-0">42</h3>
                <div class="progress mt-3" style="height: 4px;">
                    <div class="progress-bar bg-blue" style="width: 60%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-black text-slate-800 mb-0">Sales Growth Graph</h6>
                    <div class="dropdown">
                        <i class="fas fa-ellipsis-v text-muted cursor-pointer" data-bs-toggle="dropdown"></i>
                    </div>
                </div>
                <div class="bg-light-subtle rounded-4 d-flex align-items-center justify-content-center flex-column" style="height: 300px; border: 2px dashed #e2e8f0;">
                    <i class="far fa-chart-bar fs-1 text-muted mb-3 opacity-25"></i>
                    <p class="text-muted small fw-medium">Line Chart Integration Coming Soon</p>
                    <span class="badge bg-white border text-muted px-3 py-2 text-[9px] rounded-pill">CHART.JS CONNECTED</span>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white">
                <h6 class="fw-black text-slate-800 mb-4">Traffic Sources</h6>
                <div class="space-y-4">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-bold"><i class="fab fa-google me-2"></i> Search</span>
                        <span class="fw-black text-slate-700 small">45%</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <span class="text-muted small fw-bold"><i class="fab fa-facebook me-2"></i> Social</span>
                        <span class="fw-black text-slate-700 small">30%</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="text-muted small fw-bold"><i class="fas fa-link me-2"></i> Direct</span>
                        <span class="fw-black text-slate-700 small">25%</span>
                    </div>
                </div>
                <div class="mt-5 text-center">
                   <div class="position-relative d-inline-block">
                        <div class="rounded-circle border border-5 border-light" style="width: 120px; height: 120px;"></div>
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <h4 class="mb-0 fw-black text-slate-800">100%</h4>
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Palette */
    .fw-black { font-weight: 800; }
    .text-[10px] { font-size: 10px; }
    .text-[9px] { font-size: 9px; }
    
    /* Backgrounds & Colors */
    .bg-emerald-500 { background-color: #10b981; }
    .bg-soft-emerald { background-color: #f0fdf4; }
    .bg-emerald { background-color: #10b981; }
    
    .bg-soft-purple { background-color: #f5f3ff; }
    .text-purple { color: #7c3aed; }
    .bg-purple { background-color: #7c3aed; }
    
    .bg-soft-danger { background-color: #fef2f2; }
    .text-danger { color: #dc2626; }
    .bg-danger { background-color: #dc2626; }

    .bg-soft-blue { background-color: #eff6ff; }
    .text-blue { color: #2563eb; }
    .bg-blue { background-color: #2563eb; }

    .bg-soft-success { background-color: #ecfdf5; }
    .text-success { color: #059669; }

    .text-slate-800 { color: #1e293b; }
    .text-slate-700 { color: #334155; }
    .tracking-tighter { letter-spacing: -0.02em; }
    .cursor-pointer { cursor: pointer; }
</style>
@endsection