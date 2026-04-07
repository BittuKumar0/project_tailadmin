@extends('layouts.admin')

@section('page-title', 'Create Invoice')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-bold mb-4">Create New Invoice</h3>
    <form action="#" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block mb-1">Customer Name</label>
            <input type="text" class="w-full border p-2 rounded" name="customer_name">
        </div>
        <div>
            <label class="block mb-1">Invoice Total</label>
            <input type="number" class="w-full border p-2 rounded" name="total">
        </div>
        <div>
            <label class="block mb-1">Status</label>
            <select class="w-full border p-2 rounded" name="status">
                <option value="paid">Paid</option>
                <option value="pending">Pending</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Create Invoice</button>
    </form>
</div>
@endsection