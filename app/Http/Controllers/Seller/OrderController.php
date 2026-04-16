<?php

namespace App\Http\Controllers\Seller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
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
public function assignCourier(Request $request, $id)
{
    $request->validate([
        'courier_name' => 'required|string|max:255',
        'courier_phone' => 'required|string|max:20',
    ]);

    $order = \App\Models\Order::findOrFail($id);

    // Update delivery details
    $order->update([
        'courier_name' => $request->courier_name,
        'courier_phone' => $request->courier_phone,
        'assigned_at' => now(),
        'status' => 'assigned', // optional
    ]);

    return back()->with('success', 'Courier assigned successfully!');
}


public function show($id)
{
    $order = Order::with('user')->findOrFail($id);

    $shipping = ShippingAddress::where('user_id', $order->user_id)
        ->latest()
        ->first();

    return view('admin.orders.show', compact('order', 'shipping'));
}
}