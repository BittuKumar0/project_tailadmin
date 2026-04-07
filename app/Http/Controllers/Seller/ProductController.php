<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Category; 
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('seller_id', auth()->id())->latest()->paginate(10);
        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'regular_price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048' 
        ]);

        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
             
                $image->storeAs('images/products', $filename, 'public');
                $imageNames[] = $filename;
            }
        }

        Product::create([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'category_id'   => $request->category_id,
            'brand_id'      => $request->brand_id,
            'regular_price' => $request->regular_price,
            'sale_price'    => $request->sale_price,
            'stock'         => $request->stock,
            'description'   => $request->description,
            'seller_id'     => auth()->id(),
            'images'        => json_encode($imageNames), 
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
     
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // 1. Existing images handle karein
        $existingImages = is_string($product->images) ? json_decode($product->image, true) : ($product->images ?? []);

        $finalImages = $existingImages;

        // 2. Nayi images merge karein
        if ($request->hasFile('images')) {
            $newImages = [];
            foreach ($request->file('images') as $images) {
                $filename = time() . '_' . uniqid() . '.' . $images->getClientOriginalExtension();
                $images->storeAs('images/products', $filename, 'public');
                $newImages[] = $filename;
            }
            $finalImages = array_merge($existingImages, $newImages);
        }

        $product->update([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name),
            'category_id'   => $request->category_id,
            'brand_id'      => $request->brand_id,
            'regular_price' => $request->regular_price,
            'sale_price'    => $request->sale_price,
            'stock'         => $request->stock,
            'description'   => $request->description,
            'images'        => json_encode($finalImages),
        ]);

        return redirect()->route('seller.products.index')->with('success', 'Product updated successfully!');
    }

   
    public function deleteImage(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $imageName = $request->image_name; // Form ya URL se image ka naam pass karein

        if ($product->seller_id !== auth()->id()) {
            abort(403);
        }

        $images = json_decode($product->image, true);

        if (($key = array_search($imageName, $images)) !== false) {
            // Storage se delete karein
            Storage::disk('public')->delete('storage/products/' . $imageName);
            
            // Array se hatayein
            unset($images[$key]);
            
            // Database update karein
            $product->update([
                'images' => json_encode(array_values($images))
            ]);

            return back()->with('success', 'Image deleted successfully.');
        }

        return back()->with('error', 'Image not found.');
    }
}