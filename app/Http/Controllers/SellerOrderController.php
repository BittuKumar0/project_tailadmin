<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class SellerOrderController extends Controller
{
   public function show($id)
{
    $order = Order::with('user')->findOrFail($id);

    return view('seller.orders.show', compact('order'));
}
}
