@extends('layouts.app')

@section('title', $product->name ?? 'Product Details')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

        <!-- Product Images -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <img id="mainImage" 
                    src="{{ $product->images->first()?->image_path ? asset($product->images->first()->image_path) : 'https://via.placeholder.com/600x600' }}"
                     class="w-full h-auto object-cover rounded-t-xl">
                
                @if($product->images && $product->images->count() > 1)
                <div class="flex mt-4 space-x-2 overflow-x-auto pb-2">
                    @foreach($product->images as $image)
                        <img src="{{ asset($image->image_path) }}" 
                             class="w-20 h-20 object-cover rounded-lg cursor-pointer border border-gray-200 hover:border-blue-500"
                             onclick="document.getElementById('mainImage').src='{{ asset($image->image_path) }}'">
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div class="lg:col-span-3 space-y-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>

            <!-- Rating -->
            <div class="flex items-center space-x-2">
                @for($i=1;$i<=5;$i++)
                    <i class="fas fa-star text-yellow-400 {{ $i <= ($product->rating ?? 0) ? '' : 'text-gray-300' }}"></i>
                @endfor
                <span class="text-gray-500 text-sm">({{ $product->reviews_count ?? 0 }} reviews)</span>
            </div>

            <!-- Price -->
            <div class="flex items-center space-x-3">
                @if(($product->discount ?? 0) > 0)
                    <span class="text-3xl font-bold text-gray-900">₹{{ number_format($product->sale_price ?? $product->price, 0) }}</span>
                    <span class="text-gray-500 line-through">₹{{ number_format($product->price ?? 0, 0) }}</span>
                    <span class="text-white bg-red-500 text-xs px-2 py-1 rounded-full">{{ $product->discount }}% OFF</span>
                @else
                    <span class="text-3xl font-bold text-gray-900">₹{{ number_format($product->price ?? 0, 0) }}</span>
                @endif
            </div>

            <!-- Short Description -->
            <p class="text-gray-600">{{ $product->short_description ?? 'No description available.' }}</p>

            <!-- Quantity & Buy -->
            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="space-y-4">
                @csrf
                <div class="flex items-center space-x-4">
                    <label for="quantity" class="font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="quantity" value="1" min="1" class="w-20 border rounded px-3 py-1 text-center">
                </div>

                <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-2 sm:space-y-0">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors text-center w-full sm:w-auto">
                        Add to Cart
                    </button>
                    <a href="{{ route('checkout.buy-now', $product->id) }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors text-center w-full sm:w-auto">
                        Buy Now
                    </a>
                </div>
            </form>

            <!-- Full Description -->
            @if($product->description)
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 mt-6">
                <h3 class="text-lg font-semibold mb-4">Product Details</h3>
                <p class="text-gray-700">{{ $product->description }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection