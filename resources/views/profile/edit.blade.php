@extends('layouts.app')

@section('content')
<div class="profile-container">
    <h1>Edit Profile</h1>

    <!-- Success Message -->
    @if(session('status'))
        <div class="alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="profile-form">
        @csrf
        @method('PATCH')

        <!-- Name Field -->
        <div class="form-group">
            <label for="name">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name', $user->name) }}"
                placeholder="Enter your name"
            >
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="form-group">
            <label for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email', $user->email) }}"
                placeholder="Enter your email"
            >
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="form-group">
            <button type="submit" class="btn-submit">Update Profile</button>
        </div>
    </form>
</div>

<style>
/* Container */
.profile-container {
    max-width: 450px;
    margin: 50px auto;
    padding: 30px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
}

/* Heading */
.profile-container h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Success Message */
.alert-success {
    background-color: #d4edda;
    color: #155724;
    padding: 12px;
    border-radius: 5px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
}

/* Form Fields */
.profile-form .form-group {
    margin-bottom: 15px;
}

.profile-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #555;
}

.profile-form input[type="text"],
.profile-form input[type="email"] {
    width: 100%;
    padding: 10px 12px;
    border-radius: 5px;
    border: 1px solid #ccc;
    font-size: 14px;
    transition: border-color 0.3s;
}

.profile-form input[type="text"]:focus,
.profile-form input[type="email"]:focus {
    border-color: #007bff;
    outline: none;
}

/* Error Message */
.error {
    display: block;
    margin-top: 5px;
    color: #dc3545;
    font-size: 13px;
}

/* Submit Button */
.btn-submit {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: #fff;
    font-weight: bold;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s;
}

.btn-submit:hover {
    background-color: #0056b3;
}
</style>
@endsection