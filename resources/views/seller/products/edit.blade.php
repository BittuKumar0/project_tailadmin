@extends('layouts.app')

@section('title', 'Edit Product | Seller Panel')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 fw-bold text-dark">
            <i class="fas fa-edit me-2 text-success"></i>Edit Product
        </h1>
        <a href="{{ route('seller.products.index') }}" class="btn btn-outline-secondary shadow-sm rounded-pill">
            <i class="fas fa-arrow-left me-1"></i> Back to List
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-4 p-md-5">
                    
                    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-4">
                            {{-- Left Column: Details --}}
                            <div class="col-md-7">
                                <div class="mb-4">
                                    <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $product->name) }}" 
                                           class="form-control @error('name') is-invalid @enderror shadow-none border-2" placeholder="Enter product name">
                                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Category</label>
                                        <select name="category_id" class="form-select shadow-none border-2">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Brand</label>
                                        <select name="brand_id" class="form-select shadow-none border-2">
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
                                    <textarea name="description" rows="6" class="form-control shadow-none border-2">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>

                            {{-- Right Column: Price & Images --}}
                            <div class="col-md-5">
                                <div class="p-4 bg-light rounded-4 border mb-4">
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <label class="form-label fw-bold small text-muted">Regular Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-white border-2">₹</span>
                                                <input type="number" name="regular_price" value="{{ old('regular_price', $product->regular_price) }}" class="form-control shadow-none border-2 border-start-0">
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label class="form-label fw-bold small text-success">Sale Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text bg-success text-white border-success">₹</span>
                                                <input type="number" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="form-control shadow-none border-success border-2 border-start-0">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold small text-muted">Stock Quantity</label>
                                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control shadow-none border-2">
                                        </div>
                                    </div>
                                </div>

                                {{-- Image Management --}}
                                <div class="mb-4">
                                    <label class="form-label fw-bold d-block mb-2">Current Gallery</label>
                                    <div class="d-flex flex-wrap gap-2 mb-3 p-3 bg-white border rounded-3 shadow-sm">
                                        @php
                                            $imgData = $product->images; // Make sure this matches your DB column
                                            $images = is_string($imgData) ? json_decode($imgData, true) : $imgData;
                                        @endphp
                                        
                                        @if(!empty($images) && is_array($images))
                                            @foreach($images as $img)
                                                <div class="position-relative">
                                                    <img src="{{ asset('storage/images/categories/'.$img) }}" 
                                                         class="rounded border shadow-sm" 
                                                         style="width: 75px; height: 75px; object-fit: cover;"
                                                         onerror="this.src='https://via.placeholder.com/75?text=No+Image'">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="text-muted small py-2"><i class="fas fa-info-circle me-1"></i>No images uploaded.</div>
                                        @endif
                                    </div>

                                    <label class="form-label fw-bold">Add / Update Images</label>
                                    <div class="border-dashed p-4 text-center rounded-3 bg-light border-success position-relative">
                                        <i class="fas fa-images text-success fa-2x mb-2"></i>
                                        <input type="file" name="images[]" id="imageInput" multiple accept="image/*" 
                                               class="form-control shadow-none border-0 bg-transparent stretched-link opacity-0" 
                                               style="z-index: 2; cursor: pointer;">
                                        <p class="mb-0 text-muted small">Click or drag to upload multiple images</p>
                                        <div id="imagePreview" class="d-flex flex-wrap gap-2 mt-3 justify-content-center"></div>
                                    </div>
                                    <small class="text-muted mt-2 d-block small">Note: Selected images will be added to the product gallery.</small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-top d-flex gap-2">
                            <button type="submit" class="btn btn-success px-5 rounded-pill shadow-sm fw-bold">
                                <i class="fas fa-save me-2"></i> Update Product
                            </button>
                            <a href="{{ route('seller.products.index') }}" class="btn btn-light px-4 rounded-pill border">
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
    .border-dashed { border: 2px dashed #198754; position: relative; }
    .border-dashed:hover { background-color: #f0fff4 !important; }
    .form-control:focus, .form-select:focus { border-color: #198754; box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.1); }
    .rounded-4 { border-radius: 1rem !important; }
    .border-2 { border-width: 2px !important; }
</style>

<script>
    // JS for Multiple Image Preview
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const preview = document.getElementById('imagePreview');
        preview.innerHTML = ''; // Clear previous previews
        const files = e.target.files;

        if (files.length > 0) {
            [...files].forEach(file => {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const div = document.createElement('div');
                    div.innerHTML = `
                        <img src="${event.target.result}" 
                             class="rounded border shadow-sm" 
                             style="width: 60px; height: 60px; object-fit: cover;">
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }
    });
</script>
@endsection