@extends('layouts.app')

@section('title', 'Update Profile')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            <!-- Card Wrapper -->
            <div class="card shadow border-0">
                
                <!-- Card Header -->
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Update Profile</h4>
                </div>

                <!-- Card Body -->
                <div class="card-body">

                    <!-- Success Message -->
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Profile Form -->
                    <form method="POST" action="{{ route('seller.profile.update') }}">
                        @csrf
                        @method('POST')

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input id="name" type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   name="name" value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="submit" class="btn btn-primary w-50">
                                Update Profile
                            </button>
                        
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Bootstrap JS for alert dismiss -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection