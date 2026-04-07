@extends('layouts.app')

@section('title', 'Seller Home - ShopKart')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
       
     

{{-- CATEGORIES SECTION --}}
@foreach($categories as $categoryName => $products)
<section class="py-5">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">{{ $categoryName }}</h3>
            <a href="#" class="btn btn-sm btn-outline-success rounded-pill px-3">View All</a>
        </div>
        
        <div id="{{ Str::slug($categoryName) }}Carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach(array_chunk($products, 4) as $chunkIndex => $chunk)
                <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                    <div class="row g-4">
                    @foreach($chunk as $product)
                        <div class="col-md-3">
                            <div class="card product-card h-100 shadow-sm border-0 position-relative overflow-hidden">
                                
                                {{-- ✅ SALE Badge with Percentage --}}
                                @php
                                    $regular = $product['regular'] ?? 0;
                                    $sale = $product['sale'] ?? 0;
                                    $discount = ($regular > $sale && $regular > 0) ? round((($regular - $sale) / $regular) * 100) : 0;
                                @endphp

                                @if($discount > 0)
                                    <span class="sale-badge bg-danger text-white px-2 py-1 position-absolute top-0 start-0 m-2 z-index-2" style="z-index: 5; border-radius: 4px; font-weight: bold; font-size: 11px;">
                                        {{ $discount }}% OFF
                                    </span>
                                @endif

                                {{-- Product Link --}}
                                <a href="{{ route('products.show', $loop->iteration) }}" class="text-decoration-none text-dark">
                                    {{-- Product Image --}}
                                    <div class="img-container bg-light" style="height: 200px; overflow: hidden;">
                                        <img src="{{ asset($product['image']) }}"
                                             class="w-100 h-100"
                                             alt="{{ $product['name'] }}"
                                             style="object-fit: contain; padding: 10px;"
                                             onerror="this.src='https://via.placeholder.com/300x200/28a745/ffffff?text={{ str_replace(' ', '+', $product['name']) }}'">
                                    </div>

                                    <div class="card-body d-flex flex-column p-3">
                                        <h6 class="card-title mb-2 fw-semibold" style="font-size: 0.95rem; height: 40px; overflow: hidden;">
                                            {{ \Illuminate\Support\Str::limit($product['name'], 40) }}
                                        </h6>
                                        
                                        <div class="price-box mt-auto">
                                            @if($regular > $sale)
                                                <div class="text-decoration-line-through text-muted small">
                                                    ₹{{ number_format($regular, 0) }}
                                                </div>
                                                <div class="fw-bold text-success fs-5">
                                                    ₹{{ number_format($sale, 0) }}
                                                </div>
                                            @else
                                                <div class="fw-bold text-dark fs-5">
                                                    ₹{{ number_format($regular, 0) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </a>

                                {{-- Cart Controls --}}
                                <div class="cart-control p-3 border-top bg-white" style="position: relative; z-index: 10;">
                                    <button class="add-first btn btn-success w-100 fw-bold rounded-pill" data-product-id="{{ $loop->iteration }}">
                                        + Add 
                                    </button>
                                    <div class="qty-box d-none mt-0 justify-content-between align-items-center bg-success text-white rounded-pill px-2 py-1">
                                        <button class="minus btn btn-sm text-success bg-white rounded-circle fw-bold" style="width:28px; height:28px; line-height:1;">-</button>
                                        <span class="qty fw-bold">1</span>
                                        <button class="plus btn btn-sm text-success bg-white rounded-circle fw-bold" style="width:28px; height:28px; line-height:1;">+</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            
            {{-- Carousel Controls --}}
            <button class="carousel-control-prev" type="button" data-bs-target="#{{ Str::slug($categoryName) }}Carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" style="width: 30px; height: 30px;"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#{{ Str::slug($categoryName) }}Carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle" style="width: 30px; height: 30px;"></span>
            </button>
        </div>
    </div>
</section>
             </div>
                </div>
                @endforeach
            </div>
            
            {{-- Carousel Controls --}}
            <button class="carousel-control-prev" type="button" 
                    data-bs-target="#{{ Str::slug($categoryName) }}Carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" 
                    data-bs-target="#{{ Str::slug($categoryName) }}Carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        
        <div class="text-center mt-4">
            <a href="#" class="btn btn-outline-success">View All {{ $categoryName }}</a>
        </div>
    </div>
</section>



    </div>
</div>
@endsection