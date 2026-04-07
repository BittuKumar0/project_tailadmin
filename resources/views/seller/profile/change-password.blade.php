@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h4 class="mb-0">Change Password</h4>
    </div>
    <div class="card-body">

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('seller.profile.update-password') }}">
            @csrf

            <!-- Current Password -->
            <div class="mb-3 position-relative">
                <label class="form-label">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="form-control" required>
                <span class="position-absolute top-50 end-0 translate-middle-x me-3 cursor-pointer" onclick="togglePassword('current_password')">
                    <i class="fas fa-eye" id="current_password_icon"></i>
                </span>
            </div>

            <!-- New Password -->
            <div class="mb-3 position-relative">
                <label class="form-label">New Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
                <span class="position-absolute top-50 end-0 translate-middle-x me-3 cursor-pointer" onclick="togglePassword('password')">
                    <i class="fas fa-eye" id="password_icon"></i>
                </span>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3 position-relative">
                <label class="form-label">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                <span class="position-absolute top-50 end-0 translate-middle-x me-3 cursor-pointer" onclick="togglePassword('password_confirmation')">
                    <i class="fas fa-eye" id="password_confirmation_icon"></i>
                </span>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Password</button>
        </form>

    </div>
</div>

<!-- Font Awesome CDN for eye icon -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '_icon');
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection