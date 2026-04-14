@extends('layouts.app')

@section('title', 'Search Results')

@push('styles')
<style>
.search-result-page { background: #f8fdfa; }

/* CARD */
.product-card {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #eee;
    transition: 0.3s;
    display: flex;
    flex-direction: column;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.08);
    border-color: #28a745;
}

/* IMAGE */
.img-container {
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
}
.product-img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    padding: 10px;
}

/* BADGE */
.sale-badge {
    font-size: 11px;
    background: #ef4444;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
}

/* TEXT */
.product-title {
    font-size: 13px;
    font-weight: 600;
    min-height: 40px;
}

.price-box .sale-price {
    font-size: 15px;
    color: #15803d;
    font-weight: 700;
}
.price-box .regular-price {
    font-size: 12px;
    color: #999;
    text-decoration: line-through;
}

/* BUTTONS */
.btn-cart {
    font-size: 12px;
}
.btn-view {
    font-size: 12px;
}
</style>
@endpush

@section('content')
<div class="search-result-page py-5">
<div class="container-fluid px-4">

    {{-- TITLE --}}
    @if(isset($query))
        <div class="mb-4">
            <h4 class="fw-bold">
                Results for: <span class="text-success">"{{ $query }}"</span>
            </h4>
        </div>
    @endif

    {{-- PRODUCTS --}}
    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-6 g-3">

        @forelse($products as $product)

        @php
            $regular = $product->regular_price ?? 0;
            $sale = $product->sale_price ?? 0;

            $discount = ($regular > $sale && $regular > 0)
                ? round((($regular - $sale) / $regular) * 100)
                : 0;

            // IMAGE FIX
            $images = is_array($product->images)
                ? $product->images
                : json_decode($product->images, true);

            $firstImage = $images[0] ?? null;
        @endphp

        <div class="col">
            <div class="card product-card h-100 position-relative">

                {{-- DISCOUNT --}}
                @if($discount > 0)
                    <span class="sale-badge position-absolute top-0 start-0 m-2">
                        {{ $discount }}% OFF
                    </span>
                @endif

                {{-- IMAGE --}}
                <div class="img-container">
                    <img src="{{ $firstImage 
                        ? asset('storage/products/'.$firstImage) 
                        : 'https://via.placeholder.com/250x250?text=No+Image' }}"
                        class="product-img"
                        alt="{{ $product->name }}"
                        onerror="this.src='https://via.placeholder.com/250x250?text=No+Image'">
                </div>

                {{-- BODY --}}
                <div class="card-body d-flex flex-column p-2">

                    <h6 class="product-title mb-2">
                        {{ \Illuminate\Support\Str::limit($product->name, 40) }}
                    </h6>

                    {{-- PRICE --}}
                    <div class="price-box mb-2">
                        @if($sale > 0 && $sale < $regular)
                            <span class="sale-price">₹{{ number_format($sale) }}</span>
                            <span class="regular-price ms-1">₹{{ number_format($regular) }}</span>
                        @else
                            <span class="sale-price">₹{{ number_format($regular) }}</span>
                        @endif
                    </div>

                    {{-- BUTTONS --}}
                    <div class="mt-auto d-flex gap-2">

                        {{-- ADD TO CART --}}
                        <form action="{{ route('cart.add') }}" method="POST" class="w-100">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">

                            <button type="submit"
                                class="btn btn-success btn-cart w-100 rounded-pill">
                                <i class="fas fa-cart-plus"></i>
                            </button>
                        </form>

                        {{-- VIEW --}}
                        <a href="{{ route('products.show', $product->id) }}"
                           class="btn btn-outline-success btn-view w-100 rounded-pill text-center">
                            <i class="fas fa-eye"></i>
                        </a>

                    </div>

                </div>

            </div>
        </div>

        @empty
            <div class="col-12 text-center py-5 bg-white rounded shadow-sm">
                <p class="text-muted fs-4">
                    No products found for "{{ $query }}"
                </p>
                <a href="{{ url('/') }}" class="btn btn-success rounded-pill px-4">
                    Continue Shopping
                </a>
            </div>
        @endforelse

    </div>

    {{-- PAGINATION --}}
    <div class="mt-5 d-flex justify-content-center">
        {{ $products->appends(['query' => $query])->links() }}
    </div>

</div>
</div>
@endsection