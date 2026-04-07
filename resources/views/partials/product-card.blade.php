@extends('layouts.app')

@section('title', 'Welcome to TailAdmin Store')

@section('content')
<div class="bg-gray-50 min-h-screen pb-20">
    
    <div class="bg-gray-900 text-white py-16 mb-12">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-6xl font-black mb-4">Latest Tech & Fashion</h1>
            <p class="text-gray-400 text-lg mb-8">Grab the best deals on your favorite brands</p>
            <a href="#shop" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full transition shadow-lg">Shop Now</a>
        </div>
    </div>

    <div class="container mx-auto px-4" id="shop">
        
        <div class="mb-20">
            <div class="flex items-center gap-3 mb-8">
                <div class="h-10 w-2 bg-blue-600 rounded-full"></div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">Shop by Category</h2>
            </div>

            @foreach($categories as $category)
                <div class="mb-12 bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6 px-2">
                        <h3 class="text-xl font-extrabold text-gray-800">{{ $category->name }}</h3>
                        <a href="#" class="text-sm font-bold text-blue-600 hover:text-blue-800 bg-blue-50 px-4 py-2 rounded-full transition">View All Products</a>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse($category->products as $product)
                            <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow border border-gray-100 group">
                                <div class="relative overflow-hidden">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform">
                                    @if($product->sale_price < $product->price)
                                        <span class="absolute top-2 left-2 bg-red-600 text-white text-[10px] font-black px-2 py-1 rounded-md shadow-lg">SALE</span>
                                    @endif
                                </div>
                                <div class="p-4">
                                    <h4 class="text-sm font-bold text-gray-800 truncate">{{ $product->name }}</h4>
                                    <div class="flex items-center mt-2">
                                        <span class="text-blue-600 font-black text-base">₹{{ number_format($product->sale_price) }}</span>
                                        @if($product->price > $product->sale_price)
                                            <span class="text-xs text-gray-400 line-through ml-2">₹{{ number_format($product->price) }}</span>
                                        @endif
                                    </div>
                                    <button class="w-full mt-4 bg-gray-900 text-white text-xs font-bold py-2.5 rounded-xl hover:bg-black transition-all shadow-md active:scale-95">
                                        ADD TO CART
                                    </button>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-400 text-sm italic col-span-full">No products in this category.</p>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mb-20">
            <div class="flex items-center gap-3 mb-8">
                <div class="h-10 w-2 bg-red-600 rounded-full"></div>
                <h2 class="text-3xl font-black text-gray-900 tracking-tight">Featured Brands</h2>
            </div>

            <div class="space-y-16">
                @foreach($brands as $brand)
                    <div class="relative p-1">
                        <div class="mb-6 flex items-center gap-4">
                            <span class="text-2xl font-black text-gray-900 uppercase tracking-tighter italic border-b-4 border-red-500">{{ $brand->name }}</span>
                            <div class="flex-grow h-px bg-gray-200"></div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($brand->products as $product)
                                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition-shadow border border-gray-100 group">
                                    <div class="relative overflow-hidden">
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                    </div>
                                    <div class="p-4">
                                        <h4 class="text-sm font-bold text-gray-800 truncate">{{ $product->name }}</h4>
                                        <div class="flex items-center mt-2">
                                            <span class="text-red-600 font-black">₹{{ number_format($product->sale_price) }}</span>
                                        </div>
                                        <button class="w-full mt-4 border-2 border-gray-900 text-gray-900 text-xs font-bold py-2 rounded-lg hover:bg-gray-900 hover:text-white transition">
                                            QUICK VIEW
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection