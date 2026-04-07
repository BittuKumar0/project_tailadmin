<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Category;
use App\Models\Cart;
class CartController extends Controller
{
 public function index()
{
    $categories = Category::all(); 
    $cart = Session::get('cart', []);
    $totalItems = count($cart);
    $totalAmount = 0;
  
    foreach ($cart as $item) {
        $totalAmount += $item['sale_price'] * $item['quantity'];
    }
    
    // $categories bhi view me pass kar do
    return view('cart.index', compact('cart', 'totalItems', 'totalAmount', 'categories'));
}
// public function addToCart($id)
// {
//     Cart::add($id, 1); 
//     return redirect()->back()->with('success', 'Product added to cart!');
// }



public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1|max:50'
    ]);

    $product = Product::findOrFail($request->product_id);
    if ($product->stock < $request->quantity) {
        return response()->json(['error' => "Only {$product->stock} items available!"]);
    }

    $cart = session()->get('cart', []);
    $cart[$product->id]['quantity'] = ($cart[$product->id]['quantity'] ?? 0) + $request->quantity;
    $cart[$product->id]['id'] = $product->id;
    $cart[$product->id]['name'] = $product->name;
    $cart[$product->id]['image'] = $product->images;
    $cart[$product->id]['sale_price'] = $product->sale_price;
    $cart[$product->id]['regular_price'] = $product->regular_price;
    $cart[$product->id]['stock'] = $product->stock;
    $cart[$product->id]['seller_id'] = $product->seller_id;

   session()->put('cart', $cart);

    // JSON response ke bajaye redirect karein
    return redirect()->route('cart.index')->with('success', 'Product added to cart!');
}


public function remove($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }
        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    public function update(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;

        $product = Product::find($productId);
        $cart = Session::get('cart', []);

        if (isset($cart[$productId]) && $quantity <= $product->stock) {
            $cart[$productId]['quantity'] = $quantity;
            Session::put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Stock exceeded!'], 422);
    }
}
