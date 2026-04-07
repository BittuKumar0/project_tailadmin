@extends('layouts.app')

@section('content')

<div class="container text-center py-5">

<h2 class="text-success mb-3">
Order Placed Successfully 🎉
</h2>

<p>Your order has been received and is being processed.</p>

<a href="{{ route('home') }}" class="btn btn-primary mt-3">
Continue Shopping
</a>

</div>

@endsection