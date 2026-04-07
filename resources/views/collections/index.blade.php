@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- Category Title -->
    <h2 class="mb-4">{{ $category->name }} Products</h2>

    <!-- All Categories Filter -->
    <div class="mb-4">
        <h5>All Categories</h5>
        <div class="d-flex gap-2 overflow-auto">
            @foreach($categories as $cat)
                <a href="{{ route('collections.category', $cat->id) }}" class="btn btn-outline-secondary">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Products Grid (show max 6 products) -->
    <div class="row">
        @forelse($products->take(6) as $product)
        <div class="col-md-4 col-lg-3 mb-4">
            <div class="card h-100 shadow-sm">
            
                <img src="{{ asset('storage/products/'.$product->image) }}" 
                     class="card-img-top" 
                     style="height:200px; object-fit:cover;" 
                     alt="{{ $product->name }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">₹{{ number_format($product->price, 2) }}</p>
                    <div class="mt-auto">
 <button class="add-first btn btn-success w-100 fw-bold rounded-pill" data-product-id="{{ $loop->iteration }}">
                                        + Add 
                                    </button>
                                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-secondary w-100">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
            <p>No products found in this category.</p>
        @endforelse
    </div>

</div>
@endsection