@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4 px-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-black text-slate-800 mb-1">Incoming Orders</h4>
            <p class="text-muted small mb-0 font-medium text-uppercase tracking-wider text-[10px]">
                <i class="fas fa-shipping-fast me-1 text-emerald-500"></i> Farm-to-Table Order Management
            </p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-white border rounded-pill px-3 fw-bold text-[11px] shadow-sm">
                <i class="fas fa-filter me-1 text-muted"></i> Filter
            </button>
            <button class="btn btn-emerald-500 text-white rounded-pill px-4 fw-bold shadow-sm border-0 text-[11px]">
                <i class="fas fa-plus me-1"></i> New Order
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mt-2">
        <div class="table-responsive">
            <table class="table align-middle mb-0 table-hover">
                <thead class="bg-light-subtle border-bottom">
                    <tr class="text-muted small text-uppercase fw-bold tracking-wider">
                        <th class="px-4 py-3" style="width: 12%;">Order ID</th>
                        <th style="width: 20%;">Seller Details</th>
                        <th style="width: 23%;">Customer Details</th>
                        <th style="width: 15%;">Product</th>
                        <th style="width: 15%;">Total Amount</th>
                        <th style="width: 10%;">Live Status</th>
                        <th class="text-end px-4" style="width: 5%;">Action</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($orders as $order)
                    <tr class="transition-all hover-row">
                        <td class="px-4">
                            <span class="badge bg-soft-primary text-primary fw-black px-2 py-1 rounded">#ORD-{{ $order->id }}</span>
                        </td>

                        <td>
                            <span class="badge bg-soft-info text-info fw-bold px-2 py-1 rounded-pill">
                                <i class="fas fa-store me-1 text-[8px]"></i> {{ $order->seller_name ?? 'Direct Farm' }}
                            </span>
                        </td>

                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar bg-soft-emerald text-emerald-600 fw-bold me-3 shadow-sm border border-white">
                                    {{ strtoupper(substr($order->user->name ?? 'G', 0, 2)) }}
                                </div>
                                <div>
                                    <span class="fw-bold text-slate-700 small d-block mb-0">{{ $order->user->name ?? 'Guest Customer' }}</span>
                                    <span class="text-muted text-[9px]"><i class="far fa-clock me-1"></i>{{ $order->created_at->format('d M, h:i A') }}</span>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="badge bg-soft-success text-success fw-bold px-2 py-1 rounded-pill">
                                <i class="fas fa-box-open me-1 opacity-50"></i> {{ $order->product_name ?? 'Bulk Order' }}
                            </span>
                        </td>

                        <td>
                            <span class="fw-black text-slate-800 small">₹{{ number_format($order->total_price ?? $order->product_price, 2) }}</span>
                        </td>

                        <td>
                            @php
                                $statusClass = [
                                    'pending' => 'bg-soft-warning text-warning border-warning',
                                    'processing' => 'bg-soft-info text-info border-info',
                                    'completed' => 'bg-soft-emerald text-emerald-600 border-emerald',
                                    'cancelled' => 'bg-soft-danger text-danger border-danger'
                                ][$order->status] ?? 'bg-soft-secondary text-secondary';
                            @endphp
                            <span class="badge {{ $statusClass }} border rounded-pill px-3 py-2 text-[9px] text-uppercase fw-black tracking-tighter">
                                <i class="fas fa-circle me-1" style="font-size: 5px; vertical-align: middle;"></i> {{ $order->status }}
                            </span>
                        </td>

                        <td class="text-end px-4">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-details btn-sm rounded-pill px-3 fw-bold shadow-sm text-[10px]">
                                Details <i class="fas fa-chevron-right ms-1 text-[8px]"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="py-4 opacity-50">
                                <i class="fas fa-inbox fs-1 mb-3"></i>
                                <p class="text-muted small fw-medium">No orders have been placed yet.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
        <div class="card-footer bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center">
            <div class="text-muted text-[11px] fw-medium">
                Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results
            </div>
            <div class="custom-pagination">
                {{ $orders->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
/* Dashboard Styling */
.fw-black { font-weight: 800; }
.text-[9px] { font-size: 9px; }
.text-[10px] { font-size: 10px; }
.text-[11px] { font-size: 11px; }

/* Table Hover Effect */
.table-hover tbody tr.hover-row:hover {
    background-color: #f8fafc !important;
    transform: scale(1.002);
    box-shadow: inset 4px 0 0 #10b981;
}

/* Badges Soft Styling */
.bg-soft-primary { background-color: #eff6ff !important; }
.bg-soft-info { background-color: #f0f9ff !important; }
.bg-soft-success { background-color: #ecfdf5 !important; }
.bg-soft-warning { background-color: #fffbeb !important; }
.bg-soft-emerald { background-color: #ecfdf5 !important; }
.bg-soft-danger { background-color: #fef2f2 !important; }

/* Emerald Theme Overrides */
.text-emerald-600 { color: #059669; }
.bg-emerald-500 { background-color: #10b981; }

/* Avatar Circle */
.avatar {
    width: 36px;
    height: 36px;
    font-size: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

/* Action Button */
.btn-details {
    background: #fff;
    color: #475569;
    border: 1px solid #e2e8f0;
    transition: 0.2s;
}
.btn-details:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    color: #1e293b;
}

/* Custom Pagination Overrides */
.custom-pagination .pagination {
    margin-bottom: 0;
}
.custom-pagination .page-link {
    padding: 6px 12px;
    font-size: 11px;
    font-weight: 700;
    border-radius: 8px !important;
    margin: 0 2px;
    color: #64748b;
    border: 1px solid #f1f5f9;
}
.custom-pagination .page-item.active .page-link {
    background-color: #10b981;
    border-color: #10b981;
    color: white;
}
</style>
@endsection