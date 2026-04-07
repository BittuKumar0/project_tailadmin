@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Products from {{ $brand->name }}</h2>

    @if($products->count() > 0)
        <div class="row mt-4">
            @foreach($products as $product)
                @php
                    $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                @endphp

                <div class="col-md-4 mb-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100">
                        
                        <img src="{{ asset('storage/products/' . ($images[0] ?? 'default.png')) }}"
                             class="card-img-top rounded-top-4"
                             style="height:200px; object-fit:cover;"
                             alt="{{ $product->name }}">

                        <div class="card-body">
                            <h5 class="fw-bold text-dark">{{ $product->name }}</h5>

                            <p class="text-success fw-bold mb-1">
                                ₹{{ number_format($product->sale_price ?? 0, 2) }}
                            </p>

                            @if(isset($product->regular_price))
                                <small class="text-muted text-decoration-line-through">
                                    ₹{{ number_format($product->regular_price, 2) }}
                                </small>
                            @endif
                        </div>

    <div class="card-footer bg-white border-0 text-center pb-3">
    <div class="d-flex align-items-center justify-content-center gap-2">
        
        {{-- Add to Cart Form --}}
        <form action="{{ route('cart.add') }}" method="POST" class="m-0" style="flex: 1;">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            
            <button type="submit" class="btn btn-success rounded-pill fw-bold py-2 shadow-sm w-100" style="font-size: 0.9rem;">
                <i class="fas fa-cart-plus me-1"></i> Add
            </button>
        </form>

        {{-- View Details Link --}}
        <a href="{{ route('products.show', $product->id) }}" 
           class="btn btn-outline-primary rounded-pill fw-bold py-2 shadow-sm" 
           style="flex: 1; font-size: 0.9rem;">
            View Details
        </a>

    </div>
</div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-muted mt-3">No products found for this brand.</p>
    @endif
</div>
@endsection