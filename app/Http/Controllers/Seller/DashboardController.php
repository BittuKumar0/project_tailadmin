<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $sellerId = $user->id;
        
        // 1. Stats calculation
        $data = [
            'total_sales'    => OrderItem::where('seller_id', $sellerId)
                                    ->sum(DB::raw('price * quantity')) ?? 0,

            'total_orders'   => OrderItem::where('seller_id', $sellerId)
                                    ->distinct('order_id')
                                    ->count('order_id'),

            'total_products' => Product::where('seller_id', $sellerId)->count(),

            'recent_orders'  => OrderItem::where('seller_id', $sellerId)
                                    ->with(['order.user', 'product'])
                                    ->latest()
                                    ->take(5)
                                    ->get(),
        ];

        // 2. Notifications Logic
        $notifications = $user->notifications()->latest()->take(5)->get();

        return view('seller.dashboard', compact('data', 'notifications'));
    }

    public function sellerOrders()
    {
        $sellerId = Auth::id();
        
        $orders = OrderItem::with(['order.user', 'product'])
            ->where('seller_id', $sellerId)
            ->latest()
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }
}