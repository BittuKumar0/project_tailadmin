<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
 use App\Models\Category;
class UserController extends Controller
{


public function index()
{
    $products = Product::latest()->get();
    $categories = Category::all();

    return view('home', compact('products', 'categories')); 
}
}