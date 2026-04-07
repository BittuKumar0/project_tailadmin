@extends('layouts.admin')

@section('title', 'My Products')

@section('content')
<div class="container-fluid py-4">
    {{-- Header Section --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h1 class="h3 mb-1 text-gray-800 fw-bold">
                <i class="fas fa-boxes me-2 text-success"></i>My Products
            </h1>
            <p class="text-muted small mb-0">Manage your inventory and product listings</p>
        </div>
        <a href="{{ route('seller.products.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm fw-bold">
            <i class="fas fa-plus me-1"></i> Add New Product
        </a>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Product Table Card --}}
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="px-4 py-3 border-0" style="width: 80px;">#</th>
                        <th class="py-3 border-0">Product Info</th>
                        <th class="py-3 border-0">Pricing</th>
                        <th class="py-3 border-0">Inventory</th>
                        <th class="py-3 border-0">Status</th>
                        <th class="px-4 py-3 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="px-4 text-muted small">
                                #{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="me-3 position-relative">
                                        @php
                                            // 🛑 IMAGE DECODING LOGIC
                                            $imgData = $product->images; 
                                            $firstImage = 'default.jpg';

                                            if (!empty($imgData)) {
                                                // Handle double-encoded strings from DD output
                                                $decoded = is_string($imgData) ? json_decode($imgData, true) : $imgData;
                                                if(is_string($decoded)) { $decoded = json_decode($decoded, true); }

                                                if (is_array($decoded) && isset($decoded[0])) {
                                                    $firstImage = $decoded[0];
                                                } elseif (is_string($imgData)) {
                                                    $firstImage = $imgData;
                                                }
                                            }
                                        @endphp
                                        
                                        <img src="{{ asset('storage/products/' . $firstImage) }}" 
                                             alt="{{ $product->name }}" 
                                             class="rounded-3 shadow-sm border"
                                             style="width: 50px; height: 50px; object-fit: cover;"
                                             onerror="this.onerror=null; this.src='https://via.placeholder.com/50x50?text=No+Img';">
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ Str::limit($product->name, 40) }}</h6>
                                        <span class="text-muted text-xs bg-light px-2 rounded-pill border">
                                            {{ $product->category->name ?? 'General' }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">₹{{ number_format($product->sale_price ?? $product->regular_price, 2) }}</div>
                                @if($product->sale_price < $product->regular_price)
                                    <small class="text-decoration-line-through text-muted small">₹{{ number_format($product->regular_price, 2) }}</small>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold {{ $product->stock <= 5 ? 'text-danger' : 'text-dark' }}">
                                        {{ $product->stock }} <small class="fw-normal text-muted">units</small>
                                    </span>
                                    @if($product->stock <= 5 && $product->stock > 0)
                                        <small class="text-danger fw-bold text-xs" style="font-size: 10px;">LOW STOCK</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($product->stock > 0)
                                    <span class="badge bg-success-soft text-success rounded-pill px-3 py-1 small">Active</span>
                                @else
                                    <span class="badge bg-danger-soft text-danger rounded-pill px-3 py-1 small">Out of Stock</span>
                                @endif
                            </td>
                            <td class="px-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    {{-- Edit --}}
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="btn btn-outline-primary btn-sm rounded-circle shadow-xs" 
                                       style="width: 34px; height: 34px; padding-top: 6px;" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Delete --}}
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Do you really want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-circle shadow-xs" style="width: 34px; height: 34px; padding-top: 6px;">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-5 text-center text-muted">
                                <i class="fas fa-folder-open fa-3x mb-3 opacity-25"></i>
                                <p class="mb-0">No products found in your inventory.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- 🛑 PAGINATION SECTION --}}
        <div class="card-footer bg-white border-top py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-muted small">
                    Showing <span class="fw-bold text-dark">{{ $products->firstItem() ?? 0 }}</span> 
                    to <span class="fw-bold text-dark">{{ $products->lastItem() ?? 0 }}</span> 
                    of <span class="fw-bold text-dark">{{ $products->total() }}</span> results
                </div>
                <div class="pagination-container">
                    {{-- Using Bootstrap 5 Paginator --}}
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Enhancements */
    .bg-success-soft { background-color: #e8f5e9; color: #2e7d32; }
    .bg-danger-soft { background-color: #ffebee; color: #c62828; }
    .table-hover tbody tr:hover { background-color: #f9fbfd; }
    .rounded-4 { border-radius: 1rem !important; }
    .text-xs { font-size: 0.7rem; }
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

    /* Fix Pagination Icons if they are too big */
    .pagination { margin-bottom: 0; }
    .page-link { border-radius: 6px !important; margin: 0 2px; border: none; color: #198754; background: #f8f9fa; }
    .page-item.active .page-link { background-color: #198754 !important; color: white !important; }
</style>
@endsection