<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
public function index()
{
    // Join orders with products and sellers
    $orders = Order::leftJoin('products', 'orders.product_id', '=', 'products.id')
                   ->leftJoin('users as sellers', 'orders.seller_id', '=', 'sellers.id')
                   ->select(
                       'orders.*',
                       'products.name as product_name',
                       'products.sale_price as product_price',
                       'sellers.name as seller_name'
                   )
                   ->orderBy('orders.created_at', 'desc')
                   ->paginate(10); // Only 10 orders per page

    return view('admin.orders.index', compact('orders'));
}
  public function show($id)
{
    $order = Order::select('orders.*', 'products.name as product_name', 'products.sale_price as product_price')
        ->leftJoin('products', 'orders.product_id', '=', 'products.id')
        ->with('user') // to get customer info
        ->findOrFail($id);

    return view('admin.orders.show', compact('order'));
}
}   