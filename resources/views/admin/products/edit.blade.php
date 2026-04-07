@extends('layouts.admin')

@section('title', 'Edit Product | Seller Panel')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold text-dark">
            <i class="fas fa-edit me-2 text-success"></i>Edit Product
        </h1>
        {{-- Fixed Route Name: seller.products.index --}}
        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary shadow-sm rounded-pill">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    {{-- Fixed Route Name: seller.products.update --}}
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            {{-- Left Column: Details --}}
                            <div class="col-md-7">
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                                           class="form-control @error('name') is-invalid @enderror shadow-none" placeholder="Enter product name">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Category</label>
                                        <select name="category_id" class="form-select shadow-none">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Brand</label>
                                        <select name="brand_id" class="form-select shadow-none">
                                            <option value="">No Brand</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="description" rows="6" class="form-control shadow-none">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>

                            {{-- Right Column: Price & Images --}}
                            <div class="col-md-5">
                                <div class="p-4 bg-light rounded-4 border mb-4">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label class="form-label fw-bold">Regular Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white">₹</span>
                                                <input type="number" name="regular_price" value="{{ $product->regular_price }}" class="form-control shadow-none">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-bold text-success">Sale Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white">₹</span>
                                                <input type="number" name="sale_price" value="{{ $product->sale_price }}" class="form-control shadow-none border-success">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold">Stock</label>
                                            <input type="number" name="stock" value="{{ $product->stock }}" class="form-control shadow-none">
                                        </div>
                                    </div>
                                </div>

                                {{-- Image Management --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Current Images</label>
                                    <div class="d-flex flex-wrap gap-2 mb-3">
                                        @php
                                            // 🛑 Yahan error fix kiya hai (foreach logic)
                                            $images = is_string($product->image) ? json_decode($product->image, true) : $product->image;
                                        @endphp
                                        
                                        @if(!empty($images) && is_array($images))
                                            @foreach($images as $img)
                                                <div class="position-relative">
                                                    <img src="{{ asset('storage/products/'.$img) }}" 
                                                         class="rounded border shadow-sm" style="width: 80px; height: 80px; object-fit: cover;">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-muted small italic">No images currently uploaded.</div>
                                        @endif
                                    </div>

                                    <label class="form-label fw-bold">Upload New Images</label>
                                    <div class="border-dashed p-3 text-center rounded bg-white border-success">
                                        <input type="file" name="images[]" id="imageInput" multiple class="form-control shadow-none">
                                        <div id="imagePreview" class="d-flex flex-wrap gap-2 mt-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-top d-flex gap-2">
                            <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm fw-bold">
                                <i class="fas fa-check-circle me-2"></i> Save Changes
                            </button>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-light px-4 rounded-pill border">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-dashed { border: 2px dashed #198754; }
    .form-control:focus { border-color: #198754; box-shadow: none; }
    .rounded-4 { border-radius: 1rem !important; }
</style>

<script>
    // JS for Image Preview
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = '';
        [...e.target.files].forEach(file => {
            const reader = new FileReader();
            reader.onload = (event) => {
                const img = document.createElement('img');
                img.src = event.target.result;
                img.classList.add('rounded', 'border');
                img.style.width = '60px';
                img.style.height = '60px';
                img.style.objectFit = 'cover';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endsection