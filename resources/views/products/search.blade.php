@extends('layouts.app')

@push('styles')
<style>
    .search-result-page { background: #f8fdfa; }
    
    .product-card {
        transition: all 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #eee !important;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08) !important;
        border-color: #28a745 !important;
    }

    /* Image Box Fix */
    .img-container {
        height: 220px; /* Increased Size */
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }
    .product-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        padding: 15px;
        transition: transform 0.3s;
    }
    .product-card:hover .product-img { transform: scale(1.08); }

    .sale-badge {
        font-size: 0.7rem;
        background: #ef4444;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        z-index: 2;
    }

    .product-title {
        font-size: 0.85rem;
        font-weight: 600;
        height: 40px;
        color: #333;
        line-height: 1.4;
    }

    .price-box .sale-price { font-size: 1.1rem; color: #15803d; font-weight: 700; }
    .price-box .regular-price { font-size: 0.85rem; color: #999; text-decoration: line-through; }

    /* Button Styling */
    .btn-buy {
        background-color: #ff9f00;
        border: none;
        color: white;
        font-size: 0.8rem;
    }
    .btn-buy:hover { background-color: #fb923c; color: white; }
    
    .btn-cart {
        font-size: 0.8rem;
    }
</style>
@endpush

@section('content')
<div class="search-result-page py-5">
    <div class="container-fluid px-4">
        
        @if(isset($query))
            <div class="mb-4">
                <h3 class="fw-bold">Results for: <span class="text-success">"{{ $query }}"</span></h3>
            </div>
        @endif

        {{-- Grid: 6 columns on desktop --}}
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">
            @forelse($products as $product)
                @php
                    $regular = $product->regular_price ?? 0;
                    $sale = $product->sale_price ?? 0;
                    $discount = ($regular > $sale && $regular > 0) ? round((($regular - $sale) / $regular) * 100) : 0;
                @endphp

                <div class="col">
                    <div class="card product-card h-100 shadow-sm border-0 position-relative">
                        
                        @if($discount > 0)
                            <span class="sale-badge position-absolute top-0 start-0 m-2 fw-bold shadow-sm">
                                {{ $discount }}% OFF
                            </span>
                        @endif

                        {{-- Correct Image Path --}}
    <div class="img-container">
    <img src="{{ $product->image 
        ? asset('storage/products/'.$product->image) 
        : 'https://via.placeholder.com/250x250/f0f0f0/28a745?text=EasyFarming' }}"
        class="product-img"
        alt="{{ $product->name }}"
        onerror="this.src='https://via.placeholder.com/250x250/f0f0f0/28a745?text=EasyFarming'">
</div>

<div class="d-grid gap-2 mt-auto">
    
    <form action="{{ route('cart.add', $product->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success btn-cart btn-sm rounded-pill py-1 w-100">
            <i class="fas fa-cart-plus"></i> Add to Cart
        </button>
    </form>

    <a href="{{ route('checkout.direct', $product->id) }}" 
       class="btn btn-buy btn-sm rounded-pill py-1 fw-bold text-center text-decoration-none">
        BUY NOW
    </a>

</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 bg-white rounded shadow-sm">
                    <p class="text-muted fs-4">No products found for "{{ $query }}"</p>
                    <a href="{{ url('/') }}" class="btn btn-success rounded-pill px-4">Continue Shopping</a>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $products->appends(['query' => $query])->links() }}
        </div>
    </div>
</div>
@endsection