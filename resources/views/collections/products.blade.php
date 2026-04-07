@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">{{ $category->name }} Products</h2>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/products/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">${{ number_format($product->price, 2) }}</p>
                        <a href="{{ route('products.index', $product->id) }}" class="btn btn-success">View</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No products found in this category.</p>
        @endforelse
    </div>
</div>
@endsection