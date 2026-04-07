@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <h4 class="fw-black text-slate-800 mb-1">Sales & Revenue Report</h4>
            <p class="text-muted small mb-0 font-medium uppercase tracking-wider text-[10px]">Financial Period: April 2026</p>
        </div>
        <div class="d-flex gap-2">
            <div class="input-group input-group-sm shadow-sm border rounded-pill overflow-hidden bg-white">
                <span class="input-group-text bg-white border-0 text-muted px-3"><i class="far fa-calendar-alt"></i></span>
                <input type="text" class="form-control border-0 text-xs fw-bold py-2" value="01 Apr - 03 Apr 2026" style="width: 160px;">
            </div>
            <button class="btn btn-dark rounded-pill px-4 shadow-sm text-xs fw-bold">
                <i class="fas fa-file-pdf me-2 text-danger"></i> Export PDF
            </button>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-primary border-5">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small fw-black text-uppercase mb-1 tracking-tighter">Gross Revenue</p>
                        <h2 class="fw-black text-slate-800 mb-0">₹50,000</h2>
                        <span class="text-success text-[10px] fw-bold"><i class="fas fa-caret-up me-1"></i> 24% vs last month</span>
                    </div>
                    <div class="bg-soft-blue text-blue rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-chart-line fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-success border-5">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small fw-black text-uppercase mb-1 tracking-tighter">Successful Orders</p>
                        <h2 class="fw-black text-slate-800 mb-0">120</h2>
                        <span class="text-success text-[10px] fw-bold"><i class="fas fa-caret-up me-1"></i> 8% increase</span>
                    </div>
                    <div class="bg-soft-success text-success rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-shopping-bag fs-3"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white border-start border-warning border-5">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted small fw-black text-uppercase mb-1 tracking-tighter">Unique Customers</p>
                        <h2 class="fw-black text-slate-800 mb-0">80</h2>
                        <span class="text-muted text-[10px] fw-bold">Steady growth</span>
                    </div>
                    <div class="bg-soft-warning text-warning rounded-4 d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                        <i class="fas fa-users fs-3"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 py-4 px-4">
            <h6 class="fw-black text-slate-800 mb-0">Recent Sales Activity</h6>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr class="text-muted small text-uppercase fw-bold">
                        <th class="px-4 py-3">Order Ref</th>
                        <th>Customer</th>
                        <th>Payment Mode</th>
                        <th>Amount</th>
                        <th class="text-end px-4">Status</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    <tr class="hover-bg-light">
                        <td class="px-4 fw-bold text-primary small">#TXN-9921</td>
                        <td class="small fw-bold text-slate-700">Ravi Kumar</td>
                        <td><span class="badge bg-light text-dark border px-2 py-1 text-[9px]">UPI / Online</span></td>
                        <td class="fw-black small text-slate-800">₹1,250.00</td>
                        <td class="text-end px-4"><span class="text-success small fw-bold"><i class="fas fa-check-circle me-1"></i> Paid</span></td>
                    </tr>
                    <tr class="hover-bg-light">
                        <td class="px-4 fw-bold text-primary small">#TXN-9920</td>
                        <td class="small fw-bold text-slate-700">Anita Sharma</td>
                        <td><span class="badge bg-light text-dark border px-2 py-1 text-[9px]">COD</span></td>
                        <td class="fw-black small text-slate-800">₹850.00</td>
                        <td class="text-end px-4"><span class="text-warning small fw-bold"><i class="fas fa-clock me-1"></i> Pending</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-0 text-center py-3">
            <a href="#" class="text-decoration-none small fw-bold text-primary">View Full Statement <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
    </div>
</div>

<style>
    /* Styling Palette */
    .fw-black { font-weight: 800; }
    .text-[10px] { font-size: 10px; }
    .text-xs { font-size: 12px; }
    
    /* Soft Backgrounds */
    .bg-soft-blue { background-color: #eff6ff; }
    .text-blue { color: #2563eb; }
    
    .bg-soft-success { background-color: #ecfdf5; }
    .text-success { color: #059669; }
    
    .bg-soft-warning { background-color: #fffbeb; }
    .text-warning { color: #d97706; }

    .text-slate-800 { color: #1e293b; }
    .text-slate-700 { color: #334155; }
    
    .hover-bg-light:hover { background-color: #f8fafc; }
    .transition-all { transition: 0.2s all ease-in-out; }
    .tracking-tighter { letter-spacing: -0.02em; }
</style>
@endsection