<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ShippingAddress;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    // Show all orders
 public function index()
{
    $orders = Order::orderBy('created_at', 'desc')->get();
    $categories = Category::all(); // header ke liye
    return view('orders.index', compact('orders', 'categories'));
}

    // Store a new order
    public function store(Request $request)
    {
        // Save shipping address first
        $shipping = ShippingAddress::create([
            'user_id' => $request->user_id,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
        ]);

        // Save order
        $order = Order::create([
            'order_id' => Str::upper('ORD-'.uniqid()),
            'seller_id' => $request->seller_id,
            'user_id' => $request->user_id,
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'total' => $request->price * $request->quantity,
            'name' => $request->full_name,
            'shipping_id' => $shipping->id,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'payment_status' => 'pending',
            'payment_method' => $request->payment_method,
            'status' => 'ordered',
        ]);

        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
public function customerOrders()
{
    $userId = Auth::id();

    // Eager load karein orderItems aur products
    $orders = Order::with('orderItems.product')
        ->where('user_id', auth()->id()) // Current logged-in user ke liye
        ->orderBy('created_at', 'desc')
        ->paginate(10); // 10 items per page limit
    return view('orders.customer_orders', compact('orders'));
}
}