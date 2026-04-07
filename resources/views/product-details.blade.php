@extends('layouts.app')

@section('content')

<div class="container py-5">

<div class="row">

<!-- LEFT SIDE IMAGE GALLERY -->

<div class="col-md-5">

<div class="d-flex">

<!-- Thumbnails -->

<div class="me-3">

@foreach($product->images as $img)
<img 
src="{{ asset('storage/'.$img->image_path) }}"
class="img-thumbnail mb-2 thumb"
style="width:70px; cursor:pointer"
onclick="changeImage(this)">

@endforeach

</div>

<!-- Main Image -->

<div class="flex-grow-1">

<img 
id="mainImage"
src="{{ asset('storage/'.$product->images->first()->image_path ?? '') }}"
class="img-fluid border p-2">

</div>

</div>

</div>


<!-- RIGHT SIDE PRODUCT INFO -->

<div class="col-md-7">

<h2 class="fw-bold">
{{ $product->name }}
</h2>

<p class="text-muted">
Brand: {{ $product->brand ?? 'Generic' }}
</p>

<h3 class="text-danger fw-bold">
₹{{ number_format($product->price) }}
</h3>

<p class="mt-3">
{{ $product->description }}
</p>


<!-- Rating -->

<div class="mb-3">

@for($i=1;$i<=5;$i++)

<i class="fa fa-star text-warning"></i>

@endfor

<span class="text-muted">(120 reviews)</span>

</div>


<!-- Quantity -->

<div class="mb-3">

<label class="fw-bold">Quantity</label>

<input type="number" class="form-control w-25" value="1" min="1">

</div>


<!-- Buttons -->

<div class="d-flex gap-3">

<button class="btn btn-warning px-4 py-2">
<i class="fa fa-shopping-cart"></i> Add to Cart
</button>

<button class="btn btn-success px-4 py-2">
Buy Now
</button>

</div>


<!-- Extra Info -->

<hr class="my-4">

<ul>

<li>Free Delivery</li>

<li>7 Days Replacement</li>

<li>Cash on Delivery Available</li>

<li>Secure Payment</li>

</ul>

</div>

</div>
<!-- RELATED PRODUCTS -->

<div class="mt-5">

<h4 class="mb-4">Related Products</h4>

<div class="row">

@foreach($related as $item)

<div class="col-md-3">

<a href="{{ route('product.show',$item->id) }}" class="text-decoration-none">

<div class="card">

@if($item->images->first())

<img src="{{ asset('storage/'.$item->images->first()->image_path) }}" class="card-img-top">

@endif

<div class="card-body">

<h6>{{ $item->name }}</h6>

<p class="text-danger fw-bold">
₹{{ number_format($item->price) }}
</p>

</div>

</div>

</a>

</div>

@endforeach

</div>

</div>

</div>


<script>

function changeImage(img){
document.getElementById('mainImage').src = img.src;
}

</script>

@endsection