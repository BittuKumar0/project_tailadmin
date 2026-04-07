@extends('layouts.app')

@section('content')
<div class="bg-light min-vh-100 py-5">
    <div class="container">

        <!-- Breadcrumbs & Title -->
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}" class="text-success text-decoration-none">Home</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $category->name }}</li>
                    </ol>
                </nav>
                <h2 class="fw-bold text-dark m-0">
                    {{ $category->name }} <span class="text-success">Products</span>
                </h2>
            </div>
            <span class="text-muted">{{ $products->total() }} Products found</span>
        </div>

        <!-- Products Grid -->
        <div class="row g-4">
            @forelse($products as $product)
                @php
                    // Handle product images safely
                    if(is_array($product->images)) {
                        $images = $product->images;
                    } elseif(is_string($product->images)) {
                        $images = json_decode($product->images, true) ?? [];
                    } else {
                        $images = [];
                    }
                    // dd($product);
                    $firstImage = $images[0] ?? 'default.jpg';
                @endphp

                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">

                        <div class="position-relative bg-white p-3" style="height: 180px;">
                            <img src="{{ asset('storage/products/'. $firstImage) }}"
                                 style="width:100%; height:200px; object-fit:cover;">

                            @if($product->sale_price < $product->price)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-3 shadow-sm">
                                    SAVE ₹{{ $product->price - $product->sale_price }}
                                </span>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column p-3">
                            <h6 class="card-title fw-bold text-dark text-truncate mb-1">{{ $product->name }}</h6>
                            <p class="text-muted small mb-3">Genuine Quality Product</p>

                            <div class="mt-auto">
                                <div class="d-flex align-items-center gap-2 mb-3">
                                    <span class="text-success fw-bold fs-5">
                                        ₹{{ number_format($product->sale_price ?? $product->price) }}
                                    </span>
                                    @if($product->sale_price < $product->price)
                                        <small class="text-muted text-decoration-line-through">
                                            ₹{{ number_format($product->price) }}
                                        </small>
                                    @endif
                                </div>

                                <div class="d-flex justify-content-between align-items-center gap-2 mt-3">
                                          <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="1">
    
    <button type="submit" class="btn btn-success rounded-pill fw-bold py-2 shadow-sm w-100">
        <i class="fas fa-cart-plus me-1"></i> Add 
    </button>
</form>

                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2 fw-bold" style="font-size: 0.8rem; white-space: nowrap;">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="100" class="mb-3 opacity-50">
                    <h4 class="text-muted">No products found in this category.</h4>
                    <a href="{{ url('/') }}" class="btn btn-success mt-3 rounded-pill px-5">Back to Shopping</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .product-card { transition: all 0.3s ease; border: 1px solid #f0f0f0 !important; }
    .product-card:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important; border-color: #198754 !important; }
    .breadcrumb-item + .breadcrumb-item::before { content: "›"; font-size: 1.2rem; vertical-align: middle; }
    .btn-success { background-color: #198754; border-color: #198754; }
    .btn-outline-success { color: #198754; border-color: #198754; }
    .btn-outline-success:hover { background-color: #198754; color: #fff; }
</style>
@endsection