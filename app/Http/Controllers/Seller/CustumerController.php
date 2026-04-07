<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // ✅ Product Model
use App\Models\Order;   // ✅ Order Model
use Illuminate\Support\Facades\Auth;

class CustumerController extends Controller
{
 

public function dashboard()
{
    $products = Product::with('images')->get();

    return view('seller.dashboard', compact('products'));
}

    // Seller dashboard (products list)
    public function index()
    {
        $sellerId = Auth::id(); 
        $products = Product::where('seller_id', $sellerId)->get();

        return view('seller.dashboard', compact('products'));
    }

    // Add new product
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image,
            'seller_id' => Auth::id(),
        ]);

        return back()->with('success', 'Product added successfully!');
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
            $product->image = $image;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->save();

        return back()->with('success', 'Product updated successfully!');
    }

    // Seller orders page
    public function orders()
    {
        $sellerId = Auth::id();

        // Seller ke products ke orders fetch karo
        $orders = Order::whereHas('product', function($q) use ($sellerId){
            $q->where('seller_id', $sellerId);
        })->with('product','buyer')->get();

        return view('seller.orders', compact('orders'));
    }
}