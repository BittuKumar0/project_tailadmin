@extends('layouts.admin')

@section('content')

<h1 class="text-2xl font-bold mb-4">User Profile</h1>

<div class="bg-white p-6 rounded shadow">

    <p class="mb-2">
        <strong>Name:</strong> {{ Auth::user()->name }}
    </p>

    <p class="mb-2">
        <strong>Email:</strong> {{ Auth::user()->email }}
    </p>

    <p class="mb-2">
        <strong>User ID:</strong> {{ Auth::user()->id }}
    </p>

    <p class="mb-2">
        <strong>Account Created:</strong> {{ Auth::user()->created_at }}
    </p>

</div>

@endsection