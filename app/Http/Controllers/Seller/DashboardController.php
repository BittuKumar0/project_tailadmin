<?php

namespace App\Http\Controllers\Seller;
use Illuminate\Support\Facades\DB; // 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem; // Ensure this exists

class DashboardController extends Controller
{
    public function index()
    {
        $sellerId = auth()->id();
        
        // Stats fix: Sum only the items belonging to THIS seller
        $data = [
            'total_sales'    => OrderItem::where('seller_id', $sellerId)->sum(DB::raw('price * quantity')),
            'total_orders'   => OrderItem::where('seller_id', $sellerId)->distinct('order_id')->count(),
            'total_products' => Product::where('seller_id', $sellerId)->count(),
            'recent_orders'  => OrderItem::where('seller_id', $sellerId)
                                ->with('order.user')
                                ->latest()
                                ->take(5)
                                ->get(),
        ];

        return view('seller.dashboard', compact('data'));
    }

    public function sellerOrders()
    {
        $sellerId = auth()->id();
        
        // Order Items ke through fetch karein taaki data accurate ho
        $orders = OrderItem::with(['order.user', 'product'])
            ->where('seller_id', $sellerId)
            ->latest()
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }
    public function dashboard()
{
    $user = auth()->user();

    $notifications = $user->unreadNotifications; // unread
    $allNotifications = $user->notifications; // all

    return view('seller.dashboard', compact('notifications', 'allNotifications'));
}
}