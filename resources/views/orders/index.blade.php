@extends('layouts.app')
@section('title', 'All Orders')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">All Orders</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle text-center">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Pincode</th>
                    <th>Payment Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->order_id }}</td>
                        <td>
                            <strong>{{ $order->product_name }}</strong>
                           
                        </td>
                        <td>{{ $order->quantity }}</td>
                        <td>₹{{ number_format($order->price, 2) }}</td>
                        <td>₹{{ number_format($order->total, 2) }}</td>
                        <td>{{ $order->shippingAddress->full_name ?? $order->name }}</td>
                        <td>{{ $order->shippingAddress->phone ?? $order->phone }}</td>
                        <td>{{ $order->shippingAddress->email ?? $order->email }}</td>
                        <td>{{ $order->shippingAddress->address ?? $order->address }}</td>
                        <td>{{ $order->shippingAddress->city ?? '' }}</td>
                        <td>{{ $order->shippingAddress->state ?? '' }}</td>
                        <td>{{ $order->shippingAddress->pincode ?? '' }}</td>
                        <td>
                            @if(strtolower($order->payment_status) == 'paid')
                                <span class="badge bg-success">Paid</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ ucfirst($order->payment_status) }}</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="15" class="text-center">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection