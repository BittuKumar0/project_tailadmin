@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row">
                {{-- Product Summary --}}
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body p-5 text-center">
                            <img src="{{ asset('storage/' . ($product->images->first()?->image_path ?? 'images/no-image.png')) }}" 
                                 class="img-fluid rounded mb-4" style="max-height: 250px; object-fit: cover;">
                            <h3 class="fw-bold text-primary mb-3">{{ $product->name }}</h3>
                            <p class="lead text-muted mb-4">{{ Str::limit($product->description ?? '', 150) }}</p>
                            <div class="h2 fw-bold text-danger mb-1">₹{{ number_format($product->price, 0) }}</div>
                            <div class="mb-3">
                                {{-- ✅ ALWAYS SHOW "In Stock" --}}
                                <span class="badge bg-success fs-6 px-3 py-2">
                                    <i class="fas fa-check-circle me-1"></i>In Stock (Unlimited)
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Shipping Form --}}
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 h-100">
                        <div class="card-body p-5">
                            <h3 class="fw-bold mb-4 text-primary">
                                <i class="fas fa-shipping-fast me-2"></i>Shipping Information
                            </h3>
                            
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            @endif

                            <form action="{{ route('checkout.saveShipping', $product->id) }}" method="POST" id="shippingForm">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                                               value="{{ old('name') }}" required>
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                               value="{{ old('email', Auth::user()->email ?? '') }}" required>
                                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                <div class="row g-4 mt-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Phone <span class="text-danger">*</span></label>
                                        <input type="tel" name="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" 
                                               value="{{ old('phone') }}" required>
                                        @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Quantity</label>
                                        {{-- ✅ Removed stock limit - allow any quantity --}}
                                        <input type="number" name="quantity" value="1" min="1" 
                                               class="form-control form-control-lg">
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label class="form-label fw-bold">Shipping Address <span class="text-danger">*</span></label>
                                    <textarea name="address" class="form-control form-control-lg @error('address') is-invalid @enderror" 
                                              rows="4" required>{{ old('address') }}</textarea>
                                    @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="d-grid mt-4">
                                    {{-- ✅ Button ALWAYS enabled - no stock check --}}
                                    <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold shadow-lg">
                                        <i class="fas fa-arrow-right me-2"></i>Continue to Payment
                                    </button>
                                </div>
                            </form>

                            <hr class="my-4">
                            <div class="text-center">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Product
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
