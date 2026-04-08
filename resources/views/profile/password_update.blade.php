@extends('layouts.app')

@section('title', 'Update Password - EasyFarming')

@push('styles')
<style>
    .password-card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .form-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
    }
    .form-control {
        border-radius: 10px;
        padding: 12px 15px;
        border: 1px solid #dee2e6;
    }
    .form-control:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.1);
    }
    .input-group-text {
        background-color: transparent;
        border-radius: 10px;
        border-right: none;
    }
    .has-icon .form-control {
        border-left: none;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success text-decoration-none">Dashboard</a></li>
                    <li class="breadcrumb-item active">Change Password</li>
                </ol>
            </nav>

            <div class="card password-card p-4">
                <div class="text-center mb-4">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                        <i class="fas fa-lock fa-lg"></i>
                    </div>
                    <h4 class="fw-bold">Security Update</h4>
                    <p class="text-muted small">Apne account ko secure rakhne ke liye ek mazboot password set karein.</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.password-update') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <div class="input-group has-icon">
                            <span class="input-group-text"><i class="fas fa-key text-muted"></i></span>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Purana password dalein">
                        </div>
                        @error('current_password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4 text-light">

                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <div class="input-group has-icon">
                            <span class="input-group-text"><i class="fas fa-shield-alt text-muted"></i></span>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Naya password set karein">
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-group has-icon">
                            <span class="input-group-text"><i class="fas fa-check-double text-muted"></i></span>
                            <input type="password" name="password_confirmation" class="form-control" placeholder="Naya password dobara dalein">
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success btn-lg rounded-pill fw-bold shadow-sm">
                            <i class="fas fa-save me-2"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="text-muted text-decoration-none small">
                    <i class="fas fa-times me-1"></i> Cancel and go back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection