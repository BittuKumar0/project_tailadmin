<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ShippingAddress;
use App\Models\Category;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Events\OrderLocationUpdated;

class OrderController extends Controller
{

    // 📌 Orders List (Admin)
    public function index()
    {
        $orders = Order::with('shippingAddress')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $categories = Category::all();

        return view('orders.index', compact('orders', 'categories'));
    }

    // 📌 Single Product Order
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

            // Create Shipping Address
            $shipping = ShippingAddress::create([
                'user_id' => auth()->id(),
                'full_name' => $request->full_name,
                'phone' => $request->phone ?? null,
                'email' => $request->email ?? null,
                'address' => $request->address,
                'city' => $request->city ?? null,
                'state' => $request->state ?? null,
                'pincode' => $request->pincode ?? null,
            ]);

            // Create Order
            $price = $product->sale_price ?? $product->price;

            $order = Order::create([
                'order_id' => Str::upper('ORD-' . uniqid()),
                'seller_id' => $product->seller_id,
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'product_name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $price,
                'total' => $price * $request->quantity,
                'name' => $request->full_name,
                'shipping_id' => $shipping->id,
                'email' => $request->email ?? null,
                'phone' => $request->phone ?? null,
                'address' => $request->address,
                'payment_status' => 'pending',
                'payment_method' => $request->payment_method ?? 'cod',
                'status' => 'ordered',
            ]);

            // Deduct Stock
            $product->decrement('stock', $request->quantity);

            DB::commit();

            return redirect()->route('orders.index')
                ->with('success', 'Order placed and stock updated!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    // 📌 Order Details (Admin)
public function show($id)
{
    $order = DB::table('orders')
        ->leftJoin('products', 'orders.product_id', '=', 'products.id')
        ->select(
            'orders.*', 
            'products.name as product_name', 
         
            // Check karein aapke products table mein column ka naam 'sale_price' hai ya 'price'
            'products.sale_price as product_price' 
        )
        ->where('orders.id', $id)
        ->first();

    if (!$order) {
        abort(404);
    }

    // User details ke liye alag se fetch karein agar Model use nahi kar rahe
    $user = DB::table('users')->where('id', $order->user_id)->first();
    $address = DB::table('orders')->where('order_id', $order->id)->first();

    return view('admin.orders.show', compact('order', 'user', 'address'));
}

    // 📌 Cart Checkout (Multiple Products)
    public function placeOrder(Request $request)
    {
        $user = auth()->user();
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty');
        }

        try {
            DB::transaction(function () use ($user, $cart, $request) {

                $totalAmount = 0;

                foreach ($cart as $item) {
                    $price = $item['sale_price'] ?? $item['price'];
                    $totalAmount += $price * $item['quantity'];
                }

                // Create Order
                $order = Order::create([
                    'order_id' => 'ORD' . time(),
                    'user_id' => $user->id,
                    'total' => $totalAmount,
                    'status' => 'ordered',
                    'shipping_id' => $request->shipping_id ?? 1,
                ]);

                // Create Order Items
                foreach ($cart as $item) {

                    $product = Product::find($item['id']);

                    if (!$product) {
                        throw new \Exception("Product not found.");
                    }

                    if ($product->stock < $item['quantity']) {
                        throw new \Exception("Product {$product->name} is out of stock.");
                    }

                    $price = $product->sale_price ?? $product->price;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'seller_id' => $product->seller_id,
                        'quantity' => $item['quantity'],
                        'price' => $price,
                        'total' => $price * $item['quantity'],
                    ]);

                    $product->decrement('stock', $item['quantity']);
                }
            });

            session()->forget('cart');

            return redirect()->route('orders.success')
                ->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // 📌 Customer Orders
    public function customerOrders()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.customer_orders', compact('orders'));
    }

    // 📌 Live Location Update
    public function updateLocation(Request $request, $orderId)
    {
        $request->validate([
            'lat' => 'required',
            'lng' => 'required',
        ]);

        broadcast(new OrderLocationUpdated(
            $orderId,
            $request->lat,
            $request->lng
        ))->toOthers();

        return response()->json(['status' => 'Location Updated']);
    }
   // app/Http/Controllers/Admin/OrderController.php

public function updateStatus(Request $request, $id)
{
    // Order ko database se uthayein
    $order = \App\Models\Order::findOrFail($id);
    
    // Status update karein
    $order->status = $request->status;

    // Agar status 'shipped' hai, toh OTP generate karein
    if ($request->status == 'shipped') {
        $order->delivery_otp = rand(1000, 9999);
    }

    $order->save();

    return back()->with('success', 'Order status updated successfully!');
}
public function verifyOTP(Request $request)
{
    $request->validate([
        'order_id' => 'required',
        'otp' => 'required'
    ]);

    $order = \App\Models\Order::find($request->order_id);

    if ($order && $order->delivery_otp == $request->otp) {
        $order->status = 'delivered';
        $order->delivery_otp = null; // Use hone ke baad OTP khatam
        $order->save();

        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false, 'error' => 'Invalid OTP!'], 422);
}

public function trackOrder($id)
{
    // Sirf wahi user track kar sake jisne order kiya hai
    $order = Order::where('id', $id)
                  ->where('user_id', auth()->id())
                  ->firstOrFail();

    return view('orders.track', compact('order'));
}
}