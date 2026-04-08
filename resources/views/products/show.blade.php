@extends('layouts.app')

@section('title', $product->name ?? 'Product Details')

@section('content')
<div class="bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product.index') }}" class="text-success text-decoration-none">Products</a></li>
                <li class="breadcrumb-item active text-muted" aria-current="page">{{ Str::limit($product->name ?? '', 30) }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        
        <div class="col-lg-5">
            @php
                $images = is_array($product->images) ? $product->images : json_decode($product->images, true) ?? [];
                $mainImage = $images[0] ?? 'default.jpg';
            @endphp

            <div class="position-relative mb-4 bg-white rounded shadow-sm p-3 border">
                <img id="mainImage" 
                     src="{{ asset('storage/products/' . $mainImage) }}" 
                     class="w-100" 
                     style="height: 400px; object-fit: contain;" 
                     alt="{{ $product->name }}">

                <div class="position-absolute top-0 end-0 p-3 d-flex flex-column gap-2">
                    <button class="btn btn-white btn-sm shadow-sm rounded-circle border" onclick="shareProduct()"><i class="fas fa-share-alt text-success"></i></button>
                </div>
            </div>
     
            <div class="d-flex gap-2 flex-wrap">
                @foreach($images as $index => $img)
                    <img src="{{ asset('storage/products/' . $img) }}" 
                         class="img-thumbnail thumb border-2 {{ $index == 0 ? 'border-success active-thumb' : '' }}"
                         style="width: 75px; height: 75px; object-fit: cover; cursor: pointer;"
                         onclick="changeImage(this)">
                @endforeach
            </div>
        </div>

        <div class="col-lg-7">
            <div class="mb-3">
                <h1 class="fw-bold mb-2 fs-3 text-dark">{{ $product->name }}</h1>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="text-warning small">
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="text-muted small">(1,247 reviews)</span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 rounded-pill">In Stock</span>
                </div>
            </div>

            <div class="mb-4 p-4 bg-white rounded-4 shadow-sm border border-light">
                @php
                    $sale = $product->sale_price ?? $product->price;
                    $regular = $product->price;
                    $discount = $regular > $sale ? round((($regular - $sale) / $regular) * 100) : 0;
                @endphp

                <div class="d-flex align-items-baseline gap-3">
                    <h2 class="display-6 fw-bold text-danger mb-0">₹{{ number_format($sale) }}</h2>
                    @if($discount > 0)
                        <del class="text-muted fs-5">₹{{ number_format($regular) }}</del>
                        <span class="badge bg-danger rounded-pill px-3">{{ $discount }}% OFF</span>
                    @endif
                </div>
                <div class="mt-2 text-success small fw-bold">
                    <i class="fas fa-truck-moving me-1"></i> FREE Delivery Available | <i class="fas fa-shield-alt me-1"></i> 100% Quality Assurance
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold text-dark small mb-2">Select Quantity:</label>
                <div class="d-flex align-items-center border rounded-pill px-2 py-1 bg-light shadow-sm" style="width: 140px;">
                    <button type="button" class="btn btn-link text-dark text-decoration-none fw-bold fs-5" onclick="updateQty(-1)">-</button>
                    <span id="qtyDisplay" class="flex-grow-1 text-center fw-bold fs-5">1</span>
                    <button type="button" class="btn btn-link text-dark text-decoration-none fw-bold fs-5" onclick="updateQty(1)">+</button>
                </div>
                <small class="text-muted mt-2 d-block ms-2">{{ $product->stock ?? 0 }} units available</small>
            </div>

            <div class="row g-3">
                <div class="col-sm-7">
                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="hiddenCartQty" value="1">
                        
                        <button type="submit" class="btn btn-success btn-lg w-100 fw-bold rounded-pill shadow px-4 py-3 fs-6">
                            <i class="fas fa-shopping-basket me-2"></i> Add To Cart
                        </button>
                    </form>
                </div>
                <div class="col-sm-5">
                    @auth
                        <a id="buyNowBtn" 
                           href="{{ route('checkout.show', $product->id) }}"
                           class="btn btn-outline-danger btn-lg w-100 fw-bold rounded-pill shadow-sm px-4 py-3 fs-6">
                            <i class="fas fa-bolt me-1"></i> Buy Now
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg w-100 rounded-pill py-3">Login to Order</a>
                    @endauth
                </div>
            </div>

            <div class="mt-5 row g-3">
                <div class="col-6">
                    <div class="p-3 border rounded-3 bg-white shadow-xs">
                        <small class="text-muted d-block">Category</small>
                        <span class="fw-bold">{{ $product->category->name ?? 'Fresh Produce' }}</span>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 border rounded-3 bg-white shadow-xs">
                        <small class="text-muted d-block">Seller</small>
                        <span class="fw-bold text-primary"><i class="fas fa-store me-1"></i> EasyFarming</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    let currentQty = 1;
    const maxStock = {{ $product->stock ?? 1 }};

    function updateQty(change) {
        currentQty = Math.max(1, Math.min(maxStock, currentQty + change));
        
        // Update display text
        document.getElementById('qtyDisplay').innerText = currentQty;
        
        // Update hidden input for cart form
        document.getElementById('hiddenCartQty').value = currentQty;

        // Update Buy Now link dynamic URL
        const buyBtn = document.getElementById('buyNowBtn');
        if(buyBtn) {
            let baseUrl = "{{ route('checkout.show', $product->id) }}";
            buyBtn.href = baseUrl + "?qty=" + currentQty;
        }
    }

    function changeImage(element) {
        document.getElementById('mainImage').src = element.src;
        document.querySelectorAll('.thumb').forEach(t => t.classList.remove('active-thumb', 'border-success'));
        element.classList.add('active-thumb', 'border-success');
    }

    function shareProduct() {
        if(navigator.share) {
            navigator.share({ title: '{{ $product->name }}', url: window.location.href });
        } else {
            alert('Link copied to clipboard!');
            navigator.clipboard.writeText(window.location.href);
        }
    }
</script>
@endpush

@push('styles')
<style>
    .bg-success-subtle { background-color: #e8f5e9 !important; }
    .thumb { transition: all 0.2s ease; border-width: 2px !important; }
    .thumb:hover { transform: translateY(-3px); box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .active-thumb { border-color: #198754 !important; }
    .btn-lg { transition: all 0.3s ease; }
    .btn-lg:hover { transform: translateY(-2px); }
    .shadow-xs { box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
</style>
@endpush