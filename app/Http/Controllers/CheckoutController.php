<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
  use App\Models\Category;
use App\Models\ShippingAddress;
use App\Models\User;
use App\Notifications\NewOrderNotification;
class CheckoutController extends Controller
{
public function index()
{
    $cart = session()->get('cart', []);
    
    if(empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Cart is empty');
    }

    $totalAmount = 0;
    foreach($cart as $item) {
        $totalAmount += $item['sale_price'] * $item['quantity'];
    }

    return view('stripe.payment', compact('totalAmount'));
}
  
public function payment(Request $request)
{
    $request->validate([
        'full_name' => 'required',
        'phone' => 'required|digits:10',
        'email' => 'required|email',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
        'pincode' => 'required|digits:6',
    ]);

    $address = ShippingAddress::create([
        'full_name' => $request->full_name,
        'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
        'pincode' => $request->pincode,
    ]);

    return redirect()->route('checkout.payment', ['id' => $address->id]);
}

public function shippingDetails(Request $request)
{
    // 1. Validation
    $data = $request->validate([
        'full_name' => 'required|string|max:255',
        'phone'     => 'required|string|max:20',
        'email'     => 'required|email|max:255',
        'address'   => 'required|string|max:1000',
        'city'      => 'required|string|max:100',
        'state'     => 'required|string|max:100',
        'pincode'   => 'required|string|max:10',
    ]);
    if (Auth::check()) {
        $data['user_id'] = Auth::id();
    }
    $address = ShippingAddress::create($data);


    return redirect()->route('checkout.payment', ['address_id' => $address->id]);
}
public function show($id)
{
    $product = Product::findOrFail($id);
    
 
    $cart = session('cart', []);
    $cart[$id] = [
        'name' => $product->name,
        'quantity' => 1,
        'sale_price' => $product->sale_price,
        'image' => $product->images,
        'id' => $id
    ];
    
    session(['cart' => $cart]);
    
    return redirect()->route('checkout.shipping', $id);
}
 public function shipping()
    {
        return view('checkout.shipping');
    }

public function showSuccess($order_id)
    {
        $order = Order::with('shipping')->where('order_id', $order_id)->firstOrFail();

        return view('checkout.success', compact('order'));
    }
public function storeShippingDetails(Request $request) 
{
   
    $request->validate([
        'full_name' => 'required',
        'phone'     => 'required',
        'address'   => 'required',
        'city'      => 'required',
    ]);

    $shipping = ShippingAddress::updateOrCreate(
        ['user_id' => auth()->id()],
        [
            'full_name' => $request->full_name,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'address'   => $request->address,
            'city'      => $request->city,
            'state'     => $request->state,
            'pincode'   => $request->pincode,
        ]
    );
$cart = session()->get('cart', []);

foreach ($cart as $item) {
    Order::create([
        'order_id'    => 'ORD-' . strtoupper(uniqid()),
        'user_id'     => auth()->id(),
        'shipping_id' => $shipping->id,
        'product_id'  => $item['id'],
        'product_name'=> $item['name'],
        'quantity'    => $item['quantity'],
        'price'       => $item['sale_price'],
        'total'       => $item['sale_price'] * $item['quantity'],
        'status'      => 'pending',
      'seller_id' => $item['seller_id'] ?? null,
    ]);
}

    // return redirect()->route('checkout.payment', ['order_id' => $order->order_id]);
}

public function showPaymentPage($order_id) 
    {
        $order = Order::with('shipping')->where('order_id', $order_id)->firstOrFail();
        return view('checkout.payment', compact('order'));
    }

    public function cartCheckout()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Cart is empty!');
        }

        return view('checkout.cart', ['cart' => $cart]);
    }public function process(Request $request, $shipping_id)
{
    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Cart is empty!');
    }

    $order_id = 'ORD-' . time();

    // Use transaction to avoid partial order
    DB::transaction(function() use ($cart, $order_id, $shipping_id, $request) {
        foreach ($cart as $item) {
            $product = Product::find($item['id']);

            if (!$product) {
                throw new \Exception("Product not found: {$item['name']}");
            }

            // Check stock
            if ($product->stock < $item['quantity']) {
                throw new \Exception("Not enough stock for {$product->name}. Available: {$product->stock}");
            }

            // Decrement stock
            $product->decrement('stock', $item['quantity']);

            // Create order item
            $order = Order::create([
                'order_id'    => $order_id,
                'user_id'     => auth()->id() ?? 1,
                'seller_id'   => $item['seller_id'] ?? null,
                'product_id'  => $item['id'],
                'product_name'=> $item['name'],
                'quantity'    => $item['quantity'],
                'price'       => $item['sale_price'],
                'total'       => $item['sale_price'] * $item['quantity'],
                'name'        => auth()->user()->name ?? $request->name ?? 'Guest',
                'email'       => auth()->user()->email ?? $request->email ?? 'guest@mail.com',
                'phone'       => auth()->user()->phone ?? $request->phone ?? '0000000000',
                'address'     => $request->address ?? '',
                'shipping_id' => $shipping_id,
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'status'        => 'ordered',
            ]);

            // Notify the seller after order is created
            if ($order->seller_id) {
                $seller = User::find($order->seller_id); // Must be a User instance
                if ($seller) {
                    $seller->notify(new NewOrderNotification($order));
                }
            }
        }
    });

    // Clear the cart
    session()->forget('cart');

    return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
}
public function paymentPage($shipping_id)
{
    $shipping = ShippingAddress::findOrFail($shipping_id);
    $categories = Category::all(); // header ke liye

    // Pass both variables to the view
    return view('checkout.payment', compact('shipping', 'categories', 'shipping_id'));
}

}