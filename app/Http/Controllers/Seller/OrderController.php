<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index() {
        return view('seller.orders.index');
    }public function orders()
{
    $sellerId = auth()->id();
    $orders = \App\Models\Order::where('seller_id', $sellerId)->get();

    return view('seller.orders.index', compact('orders'));
}
}