@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 shadow rounded">

    <h2 class="text-xl font-bold mb-4">Edit Customer</h2>

    <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $customer->name }}" class="w-full mb-3 p-2 border rounded">

        <input type="email" name="email" value="{{ $customer->email }}" class="w-full mb-3 p-2 border rounded">

        

        <button class="bg-blue-500 text-blue px-4 py-2 rounded">Update</button>

    </form>
</div>
@endsection