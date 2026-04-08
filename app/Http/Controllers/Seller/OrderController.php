<?php

namespace App\Http\Controllers\Seller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
class OrderController extends Controller
{
public function index()
{
    $sellerId = Auth::id(); // assuming sellers log in as users

    $orders = OrderItem::with('order', 'product')
        ->where('seller_id', $sellerId)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('seller.orders.index', compact('orders'));
}
    
    
    public function orders()
{
    $sellerId = auth()->id();
    $orders = Order::where('seller_id', $sellerId)->get();

    return view('seller.orders.index', compact('orders'));
}
public function customerOrders()
{
    $orders = Order::where('user_id', auth()->id())
                    ->latest()
                    ->get();

    return view('orders.customer_orders', compact('orders'));
}
}