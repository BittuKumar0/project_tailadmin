@extends('layouts.admin')

@section('page-title', 'Transactions')

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h3 class="text-lg font-bold mb-4">All Transactions</h3>
    <table class="w-full border">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2 border">Transaction ID</th>
                <th class="p-2 border">Customer</th>
                <th class="p-2 border">Amount</th>
                <th class="p-2 border">Status</th>
            </tr>
        </thead>
        <tbody>
            <tr class="border-t">
                <td class="p-2 border">#TRX001</td>
                <td class="p-2 border">John Doe</td>
                <td class="p-2 border">$2399.00</td>
                <td class="p-2 border text-green-600">Success</td>
            </tr>
            <tr class="border-t">
                <td class="p-2 border">#TRX002</td>
                <td class="p-2 border">Jane Smith</td>
                <td class="p-2 border">$879.00</td>
                <td class="p-2 border text-red-600">Failed</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection