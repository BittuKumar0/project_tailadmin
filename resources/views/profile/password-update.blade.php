@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md mt-10 p-6 bg-white rounded-lg shadow">
    <h2 class="text-xl font-semibold mb-4">Update Password</h2>

    @if(session('status') === 'password-updated')
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">Password updated successfully.</div>
    @endif

    <form method="POST" action="{{ route('profile.password-update') }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="current_password" class="block mb-1">Current Password</label>
            <input id="current_password" name="current_password" type="password" class="w-full p-2 border rounded" required>
            @error('current_password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block mb-1">New Password</label>
            <input id="password" name="password" type="password" class="w-full p-2 border rounded" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block mb-1">Confirm New Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="w-full p-2 border rounded" required>
            @error('password_confirmation')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Update Password</button>
    </form>
</div>
@endsection