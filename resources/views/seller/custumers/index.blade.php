@extends('layouts.app')

@section('title', 'Seller Customers')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">My Customers</h1>
        <div class="text-sm text-gray-500">
            Total Customers: <span class="font-semibold text-blue-600">{{ $customers->count() }}</span>
        </div>
    </div>

    @if($customers->count() > 0)
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Orders</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Spent</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Order</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($customers as $customer)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $customer->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $customer->email }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        {{ $customer->orders->count() }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        ₹{{ number_format($customer->orders->sum('total'), 2) }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                        @if($customer->orders->last())
                            {{ $customer->orders->last()->created_at->format('M d, Y') }}
                        @else
                            Never
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="#" class="text-indigo-600 hover:text-indigo-900 mr-3">View Orders</a>
                        <a href="#" class="text-green-600 hover:text-green-900">Contact</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $customers->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No customers yet</h3>
        <p class="text-gray-500 mb-6">Customers will appear here once they place orders.</p>
        <a href="{{ route('seller.products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i>Add Products
        </a>
    </div>
    @endif
</div>
@endsection
