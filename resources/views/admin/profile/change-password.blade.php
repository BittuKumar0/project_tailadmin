@extends('layouts.admin')

@section('page-title', 'Change Password')

@section('content')
<div class="ml-64 mt-16 p-6">
    <div class="card p-4 shadow-sm bg-white rounded max-w-md">
        <h3 class="mb-4 text-xl font-semibold">Change Password</h3>

        <form method="POST" action="{{ route('admin.profile.update-password') }}">
            @csrf

            <!-- Current Password -->
            <!-- Current Password -->
<div class="mb-3 relative">
    <label class="form-label block mb-1">Current Password</label>
    <input id="current_password" type="password" name="current_password" class="form-control w-full border rounded p-2 pr-10">
    <span onclick="togglePassword('current_password', this)" class="absolute right-2 top-1/2 transform -translate-y-1/5 cursor-pointer">
        <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path id="eye-current_password" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
    </span>
</div>

<!-- New Password -->
<div class="mb-3 relative">
    <label class="form-label block mb-1">New Password</label>
    <input id="password" type="password" name="password" class="form-control w-full border rounded p-2 pr-10">
    <span onclick="togglePassword('password', this)" class="absolute right-2 top-1/2 transform -translate-y-1/5 cursor-pointer">
        <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path id="eye-password" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
    </span>
</div>

<!-- Confirm New Password -->
<div class="mb-3 relative">
    <label class="form-label block mb-1">Confirm New Password</label>
    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control w-full border rounded p-2 pr-10">
    <span onclick="togglePassword('password_confirmation', this)" class="absolute right-2 top-1/2 transform -translate-y-1/5 cursor-pointer">
        <svg class="h-5 w-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path id="eye-password_confirmation" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
    </span>
</div>

            <button type="submit" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Change Password</button>
        </form>
    </div>
</div>

<script>
function togglePassword(fieldId, btn) {
    const input = document.getElementById(fieldId);
    const pathEye = btn.querySelector('path:last-child');

    if (input.type === 'password') {
        input.type = 'text';
        // Add slash line
        pathEye.setAttribute('d', 'M3 3l18 18'); // cross line
    } else {
        input.type = 'password';
        // Restore eye path
        pathEye.setAttribute('d', 'M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
    }
}
</script>
@endsection