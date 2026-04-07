<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProductController extends Controller
{    
    public function show($id)
    {
        $product = Product::findOrFail($id); // get product or 404
        return view('product.show', compact('product'));
    }

public function index()
{
    $products = Product::with('images')->latest()->paginate(10); // Load images with products
    return view('admin.products.index', compact('products'));
}
    // Show create page
    public function create()
    {
       
        $categories = Category::all();
        $product = null; // Important: send null for create page
          $brands = \App\Models\Brand::all();
        return view('admin.products.create', compact('categories', 'product','brands'));
    }

    // Show edit page
public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();
    $brands = Brand::all(); // <-- Fetch all brands

    return view('admin.products.edit', compact('product', 'categories', 'brands'));
}
    // Store new product
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'regular_price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'images.*' => 'nullable|image|max:2048', // 2MB Max
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->slug = Str::slug($request->name);
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->regular_price = $request->regular_price;
    $product->sale_price = $request->sale_price;
    $product->stock = $request->stock;
    $product->description = $request->description;
    $product->seller_id = auth()->id();

    // 🖼️ Image Upload Logic
   if ($request->hasFile('images')) {
    $imagePaths = [];
    foreach ($request->file('images') as $images) {
        // 1. Original file name nikaalein
        $originalName = $images->getClientOriginalName();
        
        // 2. Name ko unique banayein (taaki overwrite na ho)
        // Output: 1712050000_my_product_photo.jpg
        $filename = time() . '_' . $originalName;
        
        // 3. Public storage ke 'products' folder mein move karein
        $images->move(public_path('storage/products/'), $filename);
        
        // 4. Array mein filename add karein
        $imagePaths[] = $filename;
    }
    
    // 5. Database mein JSON format mein save karein
    $product->images = json_encode($imagePaths); 
}

    $product->save();

    return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
}

    // Update product
    public function update(Request $request, Product $product)
    {
         $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'regular_price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'images.*' => 'nullable|image|max:2048', // 2MB Max
    ]);

    $product = new Product();
    $product->name = $request->name;
    $product->slug = Str::slug($request->name);
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->regular_price = $request->regular_price;
    $product->sale_price = $request->sale_price;
    $product->stock = $request->stock;
    $product->description = $request->description;
    $product->seller_id = auth()->id();

    // 🖼️ Image Upload Logic
   if ($request->hasFile('images')) {
    $imagePaths = [];
    foreach ($request->file('images') as $images) {
        // 1. Original file name nikaalein
        $originalName = $images->getClientOriginalName();
        
        // 2. Name ko unique banayein (taaki overwrite na ho)
        // Output: 1712050000_my_product_photo.jpg
        $filename = time() . '_' . $originalName;
        
        // 3. Public storage ke 'products' folder mein move karein
        $images->move(public_path('storage/products/'), $filename);
        
        // 4. Array mein filename add karein
        $imagePaths[] = $filename;
    }
    
    // 5. Database mein JSON format mein save karein
    $product->images = json_encode($imagePaths); 
}

    $product->save();


        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
{
    // 1. Database se images ka data nikalye
    $imgData = $product->images;

    // 2. Agar data string hai (JSON), toh use array mein badaliye
    $images = is_string($imgData) ? json_decode($imgData, true) : $imgData;

    // 3. Check karein ki array hai ya nahi, phir delete karein
    if (is_array($images)) {
        foreach ($images as $imageName) {
            // Check karein ki image exist karti hai ya nahi, phir delete karein
            if (Storage::disk('public')->exists('products/' . $imageName)) {
                Storage::disk('public')->delete('products/' . $imageName);
            }
        }
    }

    // 4. Product ko delete karein (aapke case mein relationship nahi hai, column hai)
    // Isliye $product->images()->delete() ki zaroorat nahi hai
    $product->delete();

    return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
}
}