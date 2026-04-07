@extends('layouts.app')

@section('title', 'My Products')

@section('content')
<div class="container-fluid py-4">
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">
            <i class="fas fa-boxes me-2 text-success"></i>My Products
        </h1>
        <a href="{{ route('seller.products.create') }}" class="btn btn-success rounded-pill px-4 shadow-sm">
            <i class="fas fa-plus me-1"></i> Add New Product
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-muted small text-uppercase">
                    <tr>
                        <th class="px-4 py-3 border-0">#</th>
                        <th class="py-3 border-0">Product Details</th>
                        <th class="py-3 border-0 text-center">Price</th>
                        <th class="py-3 border-0 text-center">Stock</th>
                        <th class="py-3 border-0 text-center">Status</th>
                        <th class="px-4 py-3 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="px-4 text-muted small">
                                {{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    {{-- Image Logic --}}
                                    @php
                                        $imgData = $product->images;
                                        $firstImage = 'default.jpg'; 

                                        if (!empty($imgData)) {
                                            // Handle Array or JSON String
                                            $decoded = is_string($imgData) ? json_decode($imgData, true) : $imgData;
                                            
                                            if (is_array($decoded) && isset($decoded[0])) {
                                                $firstImage = $decoded[0];
                                            } elseif (is_string($imgData) && !json_decode($imgData)) {
                                                $firstImage = $imgData;
                                            }
                                        }
                                        
                                        // Path check: 'storage/' prefix is important
                                        $path = 'storage/products/' . $firstImage;
                                    @endphp

                                    <img src="{{ asset($path) }}" 
                                         alt="{{ $product->name }}" 
                                         class="rounded-3 shadow-sm border"
                                         style="width: 50px; height: 50px; object-fit: cover;"
                                         onerror="this.onerror=null; this.src='https://via.placeholder.com/50x50?text=No+Image';">
                                    
                                    <div>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $product->name }}</h6>
                                        <small class="text-muted small">{{ $product->category->name ?? 'Uncategorized' }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="fw-bold text-dark">₹{{ number_format($product->sale_price ?? $product->regular_price, 0) }}</div>
                                @if($product->sale_price && $product->sale_price < $product->regular_price)
                                    <small class="text-decoration-line-through text-muted small">₹{{ number_format($product->regular_price, 0) }}</small>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($product->stock <= 0)
                                    <span class="badge bg-danger-soft text-danger rounded-pill px-3">Out of Stock</span>
                                @else
                                    <span class="fw-bold">{{ $product->stock }}</span> <small class="text-muted small">units</small>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $product->stock > 0 ? 'bg-success-soft text-success' : 'bg-secondary-soft text-secondary' }} rounded-pill px-3">
                                    {{ $product->stock > 0 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('seller.products.edit', $product->id) }}" 
                                       class="btn btn-outline-primary btn-sm rounded-circle shadow-sm d-flex align-items-center justify-content-center" 
                                       style="width: 35px; height: 35px;" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" 
                                          onsubmit="return confirm('Delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-danger btn-sm rounded-circle shadow-sm d-flex align-items-center justify-content-center" 
                                                style="width: 35px; height: 35px;" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-5 text-center text-muted">
                                <i class="fas fa-box-open fa-3x mb-3 d-block opacity-25"></i>
                                No products found. <a href="{{ route('seller.products.create') }}" class="text-success fw-bold">Add one now!</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Footer --}}
        <div class="card-footer bg-white border-top-0 py-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-muted small">
                    Showing <b>{{ $products->firstItem() }}</b> to <b>{{ $products->lastItem() }}</b> of <b>{{ $products->total() }}</b> products
                </div>
                <div class="custom-pagination">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling for Soft Badges */
    .bg-success-soft { background-color: #e8f5e9 !important; color: #2e7d32 !important; }
    .bg-danger-soft { background-color: #ffebee !important; color: #c62828 !important; }
    .bg-secondary-soft { background-color: #f5f5f5 !important; color: #757575 !important; }
    
    .table thead th { font-weight: 700; font-size: 0.7rem; color: #6c757d; }
    .rounded-4 { border-radius: 1rem !important; }
    
    /* Smooth Transitions */
    .btn-outline-primary:hover, .btn-outline-danger:hover {
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }

    /* Pagination Styling Fix */
    .custom-pagination .pagination { margin-bottom: 0; }
    .custom-pagination .page-link { padding: 0.4rem 0.8rem; color: #198754; border-radius: 6px; margin: 0 2px; }
    .custom-pagination .page-item.active .page-link { background-color: #198754; border-color: #198754; color: white; }
</style>
@endsection