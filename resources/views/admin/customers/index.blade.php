@extends('layouts.admin')

@section('content')
<div class="container py-5">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        
        <div class="card-header bg-white border-0 py-4 px-4 d-flex justify-content-between align-items-center border-bottom">
            <div>
                <h4 class="fw-black text-slate-800 mb-1">Customer Management</h4>
                <p class="text-muted small mb-0 font-medium">View and manage registered users (Admin excluded)</p>
            </div>
            <a href="#" class="btn btn-emerald-500 text-white rounded-pill px-4 fw-bold shadow-sm border-0 text-[11px]">
                <i class="fas fa-plus me-1"></i> Add New
            </a>
        </div>

        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light-subtle">
                    <tr class="text-muted small text-uppercase fw-bold tracking-wider">
                        <th class="px-4 py-3" style="width: 10%;">ID</th>
                        <th style="width: 35%;">User Details</th>
                        <th style="width: 30%;">Email Address</th>
                        <th style="width: 15%;">Role</th>
                        <th class="text-center px-4" style="width: 10%;">Actions</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($customers as $customer)
                        {{-- ID 1 (Admin) ko hide karne ki logic --}}
                        @if($customer->id != 1)
                        <tr class="hover-bg-light transition-all">
                            <td class="px-4">
                                <span class="fw-bold text-muted small">#{{ str_pad($customer->id, 3, '0', STR_PAD_LEFT) }}</span>
                            </td>

                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-soft-emerald text-emerald-600 rounded-circle d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm" style="width: 38px; height: 38px; font-size: 12px; border: 2px solid #fff;">
                                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                                    </div>
                                    <span class="fw-bold text-slate-700">{{ $customer->name }}</span>
                                </div>
                            </td>

                            <td class="text-slate-600 small font-medium">
                                <i class="far fa-envelope me-2 text-muted opacity-50"></i>
                                {{ $customer->email }}
                            </td>

                            <td>
                                <span class="badge rounded-pill bg-soft-blue text-blue px-3 py-2 text-[9px] fw-black text-uppercase">
                                    {{ $customer->role }}
                                </span>
                            </td>

                            <td class="px-4 text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    {{-- Edit Button --}}
                                    <a href="{{ route('admin.customers.edit', $customer->id) }}" 
                                       class="btn-action edit" title="Edit User">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this user?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action delete" title="Delete User">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <p class="text-muted small fw-medium mb-0">No other customers found.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Styling Variables */
    .fw-black { font-weight: 800; }
    .text-[11px] { font-size: 11px; }
    .text-[9px] { font-size: 9px; }
    
    .bg-emerald-500 { background-color: #10b981; }
    .bg-soft-emerald { background-color: #f0fdf4; }
    .text-emerald-600 { color: #059669; }
    
    .bg-soft-blue { background-color: #eff6ff; }
    .text-blue { color: #2563eb; }

    .text-slate-800 { color: #1e293b; }
    .text-slate-700 { color: #334155; }
    
    .hover-bg-light:hover { background-color: #f8fafc; }
    .transition-all { transition: 0.2s all ease-in-out; }

    /* Action Buttons Design */
    .btn-action {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 11px;
        transition: 0.2s;
        border: none;
        text-decoration: none;
    }
    .btn-action.edit { background: #fffbeb; color: #d97706; border: 1px solid #fef3c7; }
    .btn-action.edit:hover { background: #fef3c7; transform: translateY(-2px); }
    
    .btn-action.delete { background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2; }
    .btn-action.delete:hover { background: #fee2e2; transform: translateY(-2px); }
</style>
@endsection
<script>
$(document).ready(function() {
    $('.table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.orders.index') }}",
        columns: [
            { data: 'id', name: 'id', render: function(data, type, row) {
                return '#ORD-' + data;
            }},
            { data: 'customer', name: 'customer' },
            { data: 'products', name: 'products' },
            { data: 'total_price', name: 'total_price' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false, 
              render: function() {
                return '<a href="#" class="btn btn-sm btn-light rounded-pill px-3 fw-bold border shadow-sm">Details</a>';
              }
            }
        ]
    });
});
</script>