@extends('layouts.app')

@section('title', $product->name ?? 'Product Details')

@section('content')
<!-- Breadcrumb -->
<div class="bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product->name ?? '', 30) }}</li>
            </ol>
        </nav>
    </div>
</div>

<div class="container py-5">
    <div class="row g-4">
        <!-- LEFT: Images (40%) -->
        <div class="col-lg-5">
            @php
                // Decode images safely
                if(is_array($product->images)) {
                    $images = $product->images;
                } elseif(is_string($product->images)) {
                    $images = json_decode($product->images, true) ?? [];
                } else {
                    $images = [];
                }

                $mainImage = $images[0] ?? 'default.jpg';
            @endphp

            <!-- Main Image -->
            <div class="position-relative mb-4">
                <img id="mainImage" src="{{ asset('storage/products/' . $mainImage) }}" 
                     class="w-100 h-100" 
                     style="object-fit: contain;" 
                     alt="{{ $product->name }}"
                     onerror="this.onerror=null;this.src='https://via.placeholder.com/300x200?text=No+Image+Found'">

                <!-- Quick View & Share -->
                <div class="position-absolute top-3 end-3 d-flex gap-2">
                    <button class="btn btn-sm btn-outline-light border-0 p-2 shadow-sm" onclick="quickView()">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-light border-0 p-2 shadow-sm" onclick="shareProduct()">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>
     
            <!-- Image Thumbnails -->
            <div class="d-flex gap-2 flex-wrap">
                @forelse($images as $index => $img)
                    <img src="{{ asset('storage/products/' . $img) }}" 
                         class="img-thumbnail thumb border-2 {{ $index == 0 ? 'border-success active-thumb' : '' }}"
                         style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;"
                         onclick="changeImage('{{ asset('storage/products/' . $img) }}')"
                         alt="Thumbnail {{ $index + 1 }}">
                @empty
                    <img src="https://via.placeholder.com/80x80?text=No+Image" 
                         class="img-thumbnail border-2 active-thumb" 
                         alt="No image">
                @endforelse
            </div>
        </div>

        <!-- RIGHT: Product Info (60%) -->
        <div class="col-lg-7">
            <!-- Product Title & Ratings -->
            <div class="mb-4">
                <h1 class="fw-bold mb-2 fs-3">{{ $product->name ?? 'Product Name' }}</h1>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <div class="d-flex">
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star text-warning"></i>
                        <i class="fas fa-star-half-alt text-warning"></i>
                    </div>
                    <span class="text-muted">4.5 (1,247 reviews)</span>
                    <span class="badge bg-light text-dark border">In Stock</span>
                </div>
            </div>

            <!-- Price & Discount -->
            <div class="mb-4 p-3 bg-white rounded shadow-sm border">
                @php
                    $salePrice = $product->sale_price ?? $product->price ?? 0;
                    $regularPrice = $product->price ?? $salePrice;
                    $discount = $regularPrice > $salePrice ? round((($regularPrice - $salePrice) / $regularPrice) * 100) : 0;
                @endphp

                <div class="d-flex align-items-center gap-3 mb-3">
                    @if($discount > 0)
                        <span class="text-decoration-line-through fs-5 text-muted">₹{{ number_format($regularPrice, 0) }}</span>
                    @endif
                    <span class="display-5 fw-bold text-danger">₹{{ number_format($salePrice, 0) }}</span>
                    @if($discount > 0)
                        <span class="badge bg-danger fs-6 px-2 py-1 fw-bold">{{ $discount }}% off</span>
                    @endif
                </div>
                <small class="text-success fw-bold">
                    <i class="fas fa-shipping-fast me-1"></i>
                    FREE delivery Tomorrow | EMI available
                </small>
            </div>

            <!-- Quantity Selector & Cart -->
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="form-label fw-bold small mb-1">Quantity:</label>
                    <div class="qty-selector d-flex align-items-center border rounded-pill px-3 py-2 bg-light" style="max-width: 150px;">
                        <button type="button" class="btn btn-outline-secondary border-0 p-2 fs-5" onclick="updateQuantity(-1)">-</button>
                        <span id="productQty" class="flex-grow-1 text-center fw-bold fs-5 mx-3">1</span>
                        <button type="button" class="btn btn-outline-secondary border-0 p-2 fs-5" onclick="updateQuantity(1)">+</button>
                        <input type="hidden" id="hiddenQty" value="1" min="1" max="{{ $product->stock ?? 999 }}">
                    </div>
                    <small class="text-muted mt-1 d-block">{{ $product->stock ?? 999 }} items left</small>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row g-2 mb-4">
                <div class="col-7">
          <form action="{{ route('cart.add') }}" method="POST">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <input type="hidden" name="quantity" value="1">
    
    <button type="submit" class="btn btn-success btn-lg w-100 fw-bold rounded-pill shadow-lg px-4 py-3 fs-5">
        <i class="fas fa-cart-plus me-1"></i> Add 
    </button>
</form>

                </div>
                <div class="col-5">
                    @auth
                        <a href="{{ route('checkout.show', $product->id) }}" class="btn btn-danger btn-lg w-100 fw-bold rounded-pill shadow-lg px-4 py-3 fs-5">
                            <i class="fas fa-bolt me-2"></i>Buy Now
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg w-100 fw-bold rounded-pill px-4 py-3 fs-5">
                            <i class="fas fa-sign-in-alt me-2"></i>Login to Buy
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Category & Seller -->
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-2"><i class="fas fa-tag me-2 text-success"></i>Category</h6>
                            <p class="mb-0">{{ $product->category->name ?? 'categorized' }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h6 class="fw-bold mb-2"><i class="fas fa-user me-2 text-primary"></i>Seller</h6>
                            <p class="mb-0">EasyFarming</p>
                            <small class="text-success">✓ Trusted Seller</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
@push('scripts')
<script>
let currentQty = 1;
const maxQty = {{ $product->stock ?? 999 }};

function updateQuantity(change) {
    currentQty = Math.max(1, Math.min(maxQty, currentQty + change));
    document.getElementById('productQty').textContent = currentQty;
    document.getElementById('cartQuantity').value = currentQty;
    document.getElementById('hiddenQty').value = currentQty;
}

function changeImage(src) {
    document.getElementById('mainImage').src = src;
    document.querySelectorAll('.thumb').forEach(thumb => thumb.classList.remove('active-thumb'));
    event.target.classList.add('active-thumb');
}

function quickView() { alert('Quick view coming soon!'); }
function shareProduct() {
    if(navigator.share) navigator.share({ title: '{{ $product->name }}', url: window.location.href });
    else { navigator.clipboard.writeText(window.location.href); alert('Link copied!'); }
}

document.getElementById('addToCartForm').addEventListener('submit', function(e) {
    e.preventDefault(); // prevent normal form submit

    let form = e.target;
    let formData = new FormData(form);

    fetch("{{ route('cart.add') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}",
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            // redirect to cart page
            window.location.href = "{{ route('cart.index') }}";
        } else if (data.error) {
            alert(data.error);
        }
    })
    .catch(err => console.error(err));
});
</script>
@endpush

@push('styles')
<style>
.cursor-pointer { cursor: pointer; }
.thumb:hover, .active-thumb { border-color: #28a745 !important; transform: scale(1.05); }
.qty-selector button:hover { transform: scale(1.1); }
</style>
@endpush
@endsection