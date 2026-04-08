<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ShippingAddress;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderItem; // Ensure 'I' is Capital here
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{


public function index()
{
    // Old code: $orders = Order::orderBy('created_at', 'desc')->get();
    // New Code for Pagination:
    $orders = Order::with('shippingAddress')->orderBy('created_at', 'desc')->paginate(10);
    
    $categories = Category::all(); 
    return view('orders.index', compact('orders', 'categories'));
}

    // Store a new order (Single Product Purchase)
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'full_name' => 'required',
            'address' => 'required',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Sorry, ' . $product->name . ' is out of stock!');
        }

        try {
            DB::beginTransaction();

            $shipping = ShippingAddress::create([
                'user_id' => auth()->id(),
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'pincode' => $request->pincode,
            ]);

            $order = Order::create([
                'order_id' => Str::upper('ORD-'.uniqid()),
                'seller_id' => $product->seller_id, 
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'product_name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->sale_price ?? $product->price,
                'total' => ($product->sale_price ?? $product->price) * $request->quantity,
                'name' => $request->full_name,
                'shipping_id' => $shipping->id,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method ?? 'cod',
                'status' => 'ordered',
            ]);

            // ⭐ Inventory Deduction Fix ⭐
            // decrement() use karne ke baad $product ko save() karne ki zaroorat nahi hoti
            $product->decrement('stock', $request->quantity);

            DB::commit();
            return redirect()->route('orders.index')->with('success', 'Order placed and Stock updated!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    // Full Cart Checkout (Multi-product Purchase)

public function show($id)
{
    $order = Order::where('id', $id)
                  ->where('user_id', auth()->id()) // 🔐 security
                  ->firstOrFail();

    return view('orders.show', compact('order'));
}


public function placeOrder(Request $request)
{
    $user = auth()->user();
    $cart = session('cart', []); // or your cart data source
    if(empty($cart)) {
        return back()->with('error', 'Cart is empty');
    }

    DB::transaction(function() use ($user, $cart) {
        // 1. Create order
        $order = Order::create([
            'order_id' => 'ORD' . time(), // simple unique order ID
            'user_id' => $user->id,
            'total' => array_sum(array_map(fn($item)=> $item['sale_price'] * $item['quantity'], $cart)),
            'status' => 'ordered',
            'shipping_id' => $request->shipping_id ?? 1,
          
        ]);

        // 2. Create order items & deduct stock
        foreach($cart as $item) {
            $product = Product::find($item['id']);

            // Check stock
            if($product->stock < $item['quantity']) {
                throw new \Exception("Product {$product->name} is out of stock.");
            }

            // Create order item
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'seller_id' => $product->seller_id,
                'quantity' => $item['quantity'],
                'price' => $product->sale_price,
                'total' => $product->sale_price * $item['quantity'],
            ]);

            // Deduct stock
            $product->decrement('stock', $item['quantity']);
        }
    });

    // Clear cart
    session()->forget('cart');

    return redirect()->route('orders.success')->with('success', 'Order placed successfully!');
}
public function customerOrders()
{
    $orders = Order::where('user_id', auth()->id())
                    ->latest()
                    ->paginate(10); 

    return view('orders.customer_orders', compact('orders'));
}
}