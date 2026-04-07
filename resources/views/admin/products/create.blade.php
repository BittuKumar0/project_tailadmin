@extends('layouts.admin')

@section('title', 'Add New Product')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-success text-white p-4 rounded-top-4">
                    <h3 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Add New Product</h3>
                    <p class="mb-0 text-white-50">Fill in the details below to list a new agricultural product.</p>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if(session('success'))
                        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger border-0 shadow-sm">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-4">
                            <div class="col-12">
                                <label class="form-label fw-bold">Product Name <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fas fa-tag text-success"></i></span>
                                    <input type="text" name="name" value="{{ old('name') }}" required 
                                           class="form-control shadow-none" placeholder="e.g. Organic Wheat Seeds">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                                <select name="category_id" required class="form-select shadow-none">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Brand</label>
                               <select name="brand_id">
    @foreach($brands as $brand)
        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
    @endforeach
</select>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Product Images <span class="text-muted text-xs">(Multiple allowed)</span></label>
                                <div class="border-dashed p-4 text-center rounded-3 bg-light border-success">
                                    <input type="file" name="images[]" multiple class="form-control mb-2 shadow-none" id="imageInput">
                                    <small class="text-muted"><i class="fas fa-info-circle me-1"></i> Images will be saved with their original names.</small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Regular Price <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" name="regular_price" step="0.01" required class="form-control shadow-none" placeholder="0.00">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Sale Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">₹</span>
                                    <input type="number" name="sale_price" step="0.01" class="form-control shadow-none" placeholder="0.00">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold">Stock Quantity <span class="text-danger">*</span></label>
                                <input type="number" name="stock" required class="form-control shadow-none" placeholder="100">
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold">Product Description</label>
                                <textarea name="description" rows="4" class="form-control shadow-none" 
                                          placeholder="Describe your product features, usage, etc."></textarea>
                            </div>

                            <div class="col-12 d-flex gap-2 pt-3">
                                <button type="submit" class="btn btn-success btn-lg px-5 rounded-pill shadow-sm">
                                    <i class="fas fa-save me-2"></i>List Product
                                </button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-light btn-lg px-4 rounded-pill border">
                                    Cancel
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
        border: 2px dashed #198754;
        transition: all 0.3s ease;
    }
    .border-dashed:hover {
        background-color: #f0fff4 !important;
    }
    .form-control:focus, .form-select:focus {
        border-color: #198754;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
    }
    .rounded-4 { border-radius: 1rem !important; }
    .rounded-top-4 { border-top-left-radius: 1rem !important; border-top-right-radius: 1rem !important; }
</style>
@endsection