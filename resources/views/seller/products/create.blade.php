@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                {{-- Header --}}
                <div class="card-header bg-success text-white p-4 border-0">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-plus-circle fa-2x me-3"></i>
                        <div>
                            <h3 class="mb-0 fw-bold">Add New Product</h3>
                            <p class="mb-0 text-white-50 small">Fill in the details to list your agricultural product.</p>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm rounded-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            {{-- Product Name --}}
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" required 
                                       class="form-control form-control-lg shadow-none border-2" 
                                       placeholder="e.g. Organic Wheat Seeds">
                            </div>

                            {{-- Category & Brand --}}
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Category <span class="text-danger">*</span></label>
                                <select name="category_id" required class="form-select form-control-lg shadow-none">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold text-dark">Brand</label>
                                <select name="brand_id" class="form-select form-control-lg shadow-none">
                                    <option value="">No Brand / Generic</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Multiple Images Upload --}}
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark">Product Images <span class="text-muted small">(Upload multiple)</span></label>
                                <div class="upload-zone p-4 text-center rounded-3 bg-light border-dashed">
                                    <i class="fas fa-cloud-upload-alt fa-3x text-success mb-3"></i>
                                    <input type="file" name="images[]" id="imageInput" multiple accept="image/*" 
                                           class="form-control shadow-none border-0 bg-transparent">
                                    <div id="fileHelp" class="form-text mt-2 text-muted">
                                        <span id="fileCount">Selected 0 images.</span> Max 2MB per image.
                                    </div>
                                </div>
                            </div>

                            {{-- Pricing & Stock --}}
                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Regular Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">₹</span>
                                    <input type="number" name="regular_price" step="0.01" required 
                                           class="form-control shadow-none border-start-0" placeholder="0.00">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Sale Price</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">₹</span>
                                    <input type="number" name="sale_price" step="0.01" 
                                           class="form-control shadow-none border-start-0" placeholder="0.00">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold text-dark">Stock <span class="text-danger">*</span></label>
                                <input type="number" name="stock" required class="form-control shadow-none" placeholder="e.g. 50">
                            </div>

                            {{-- Description --}}
                            <div class="col-12">
                                <label class="form-label fw-bold text-dark">Description</label>
                                <textarea name="description" rows="4" class="form-control shadow-none" 
                                          placeholder="Enter product features, quality details, etc.">{{ old('description') }}</textarea>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="col-12 d-flex gap-3 pt-4">
                                <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm">
                                    <i class="fas fa-check-circle me-2"></i>List Product
                                </button>
                                <a href="{{ route('seller.products.index') }}" class="btn btn-outline-secondary btn-lg px-4 rounded-pill">
                                    Back to List
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .border-dashed {
        border: 2px dashed #198754 !important;
        transition: all 0.2s ease;
    }
    .upload-zone:hover {
        background-color: #f1f8f4 !important;
    }
    .form-control-lg, .form-select {
        border-radius: 0.75rem;
        font-size: 1rem;
    }
    .rounded-4 { border-radius: 1rem !important; }
    .input-group-text { border-radius: 0.75rem 0 0 0.75rem; }
    .input-group .form-control { border-radius: 0 0.75rem 0.75rem 0; }
</style>

<script>
    // File input change detection
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const count = e.target.files.length;
        const display = document.getElementById('fileCount');
        if(count > 0) {
            display.innerHTML = `<strong><i class="fas fa-images me-1"></i> ${count} images selected</strong>`;
            display.classList.add('text-success');
        } else {
            display.innerText = "Selected 0 images.";
            display.classList.remove('text-success');
        }
    });
</script>
@endsection