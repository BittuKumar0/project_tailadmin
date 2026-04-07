<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;


class HomeController extends Controller
{
public function index()
{
    // Sirf wahi categories uthayein jinme products hain
    $categories = Category::with(['products' => function($query) {
        $query->latest()->take(4); // Har category ke latest 4 products
    }])->has('products')->get();

    // Sirf wahi brands uthayein jinme products hain
    $brands = Brand::with(['products' => function($query) {
        $query->latest()->take(4);
    }])->has('products')->get();

    return view('home', compact('categories', 'brands'));
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
}