@extends('layouts.app')

@section('title', 'Edit Profile - EasyFarming')

@push('styles')
<style>
    .profile-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }
    .profile-avatar-circle {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        font-size: 2.5rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        border-radius: 50%;
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.2);
    }
    .form-label {
        font-weight: 600;
        color: #555;
        margin-left: 5px;
    }
    .custom-input {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        background-color: #fcfcfc;
        transition: all 0.3s ease;
    }
    .custom-input:focus {
        background-color: #fff;
        border-color: #28a745;
        box-shadow: 0 0 0 0.25rem rgba(40, 167, 69, 0.1);
    }
    .btn-update {
        border-radius: 12px;
        padding: 12px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            
            <div class="card profile-card p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="profile-avatar-circle">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <h3 class="fw-bold text-dark">Personal Info</h3>
                        <p class="text-muted small">Apne profile details yahan se update karein</p>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-success alert-dismissible fade show border-0 rounded-3 shadow-sm mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i> {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" style="border-radius: 12px 0 0 12px;">
                                    <i class="far fa-user text-muted"></i>
                                </span>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control custom-input border-start-0 @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}"
                                    placeholder="Enter your name"
                                    style="border-radius: 0 12px 12px 0;"
                                >
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block mt-2 ms-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" style="border-radius: 12px 0 0 12px;">
                                    <i class="far fa-envelope text-muted"></i>
                                </span>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control custom-input border-start-0 @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}"
                                    placeholder="Enter your email"
                                    style="border-radius: 0 12px 12px 0;"
                                >
                            </div>
                            @error('email')
                                <div class="invalid-feedback d-block mt-2 ms-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2 mt-2">
                            <button type="submit" class="btn btn-success btn-update shadow-sm">
                                <i class="fas fa-sync-alt me-2"></i> Save Changes
                            </button>
                            <a href="{{ route('home') }}" class="btn btn-link text-muted text-decoration-none btn-sm mt-2">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="text-muted small">
                    Password badalna chahte hain? 
                    <a href="{{ route('profile.password-update') }}" class="text-success fw-bold text-decoration-none">Change Password</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection