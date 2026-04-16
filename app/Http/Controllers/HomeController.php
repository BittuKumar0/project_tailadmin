<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{



public function index()
{
    // Categories
    $categories = Category::with(['products' => function($query) {
        $query->latest()->take(4);
    }])->has('products')->get();

    // Brands
    $brands = Brand::with(['products' => function($query) {
        $query->latest()->take(4);
    }])->has('products')->get();

    // 🔥 YAHAN ADD KARNA HAI (Trending Products)
    $trendingProducts = Product::withSum('orderItems as total_sold', 'quantity')
        ->orderByDesc('total_sold')
        ->limit(8)
        ->get();

    // 👇 yahan pass karna mat bhoolna
    return view('home', compact('categories', 'brands', 'trendingProducts'));

} 

public function show($idOrSlug)
{
    // Pehle slug se dhoondein, agar nahi mile toh ID se
    $product = Product::with('images')
        ->where('slug', $idOrSlug)
        ->orWhere('id', $idOrSlug)
        ->firstOrFail();

    $related = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(4)
        ->get();

    return view('products.show', compact('product', 'related'));
}


public function home()
{
    $trendingProducts = DB::table('products')
        ->join('order_items', 'products.id', '=', 'order_items.product_id')
        ->select(
            'products.*',
            DB::raw('SUM(order_items.quantity) as total_sold')
        )
        ->groupBy('products.id')
        ->orderByDesc('total_sold') // sabse jyada bikne wala pehle
        ->limit(8) // sirf 8 products
        ->get();

    return view('home', compact('trendingProducts'));
}
}