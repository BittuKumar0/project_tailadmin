@extends('layouts.admin')

@section('page-title', 'Update Profile')

@section('content')
<div class="ml-64 mt-16 p-6">
    <div class="card p-4 shadow-sm bg-white rounded">
        <h3 class="mb-4 text-xl font-semibold">Update Profile</h3>

        <form method="POST" action="{{ route('admin.profile.update') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label block mb-1">Name</label>
                <input type="text" name="name" class="form-control w-full border rounded p-2" value="{{ old('name', $user->name) }}">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label block mb-1">Email</label>
                <input type="email" name="email" class="form-control w-full border rounded p-2" value="{{ old('email', $user->email) }}">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Update Profile
            </button>
        </form>
    </div>
</div>
@endsection