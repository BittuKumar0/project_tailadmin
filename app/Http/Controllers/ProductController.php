<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand; 
use App\Models\ProductImage;
use App\Models\Category; 
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // List all products
public function index()
{
    // Paginate 10 products per page
    $products = Product::with(['brand', 'category', 'images'])
                       ->where('seller_id', auth()->id())
                       ->paginate(10); 

$products = Product::where('seller_id', auth()->id())
            ->orderBy('id', 'desc')
            ->paginate(10);
    return view('seller.products.index', compact('products'));
}


public function categoryProducts($category_id)
{
    // Find category by ID
    $category = Category::find($category_id);

    if(!$category){
        abort(404); 
    }


    $products = $category->products()->with('brand')->get();

    
    $categories = Category::all();
    $brands = Brand::all();

    return view('products.index', compact('category', 'products', 'categories', 'brands'));
}
//   public function create()
//     {
//         $brands = Brand::all(); // send brands to the form
//         return view('seller.products.create', compact('brands'));
//     }

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

    return redirect()->route('seller.products.index')->with('success', 'Product created successfully!');
}

public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();
    $brands = Brand::all();
    return view('seller.products.edit', compact('product', 'categories', 'brands'));
}
public function update(Request $request, $id)
{
    // 1. Purana product dhoondein (Naya 'new Product()' nahi banana)
    $product = Product::findOrFail($id);

    // 2. Validation
    $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'regular_price' => 'required|numeric',
        'sale_price' => 'nullable|numeric',
        'stock' => 'required|integer',
        'description' => 'nullable|string',
        'images.*' => 'nullable|image|max:2048', 
    ]);

    // 3. Data Update karein
    $product->name = $request->name;
    $product->slug = Str::slug($request->name);
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;
    $product->regular_price = $request->regular_price;
    $product->sale_price = $request->sale_price;
    $product->stock = $request->stock;
    $product->description = $request->description;
    // seller_id change karne ki zaroorat nahi hoti update mein

    // 4. Image Upload Logic
   if ($request->hasFile('images')) { // Check karein 'images' (plural) hai ya nahi
    $imagePaths = [];
    foreach ($request->file('images') as $file) {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/products'), $filename);
        $imagePaths[] = $filename;
    }
    
    // Yahan dhyan dein: Database column ka naam 'image' hai ya 'images'?
    // Jo naam index page par use kiya wahi yahan likhein
    $product->images = json_encode($imagePaths); 
}
    // 5. Save changes
    $product->save();

    return redirect()->route('seller.products.index')->with('success', 'Product updated successfully!');
}

public function deleteImage($id)
{
    $image = ProductImage::findOrFail($id);
    if(file_exists(storage_path('app/public/'.$image->image_path))){
        unlink(storage_path('app/public/'.$image->image_path));
    }
    $image->delete();

    return back()->with('success', 'Image deleted successfully!');
}  public function destroy($id)
{
    $product = Product::findOrFail($id);
    
    // Images delete karne ka logic (optional but recommended)
    if($product->image) {
        $images = is_array($product->image) ? $product->image : json_decode($product->image, true);
        if($images) {
            foreach($images as $img) {
                $path = public_path('storage/products/' . $img);
                if(file_exists($path)) unlink($path);
            }
        }
    }

    $product->delete();
    return back()->with('success', 'Product deleted successfully!');
}

public function create()
{
    $categories = Category::all();
    $brands = Brand::all(); // Fetch brands for select input
    return view('seller.products.create', compact('categories', 'brands'));
}  


 public function collections()
{
    $categories = Category::all(); // all categories fetch karo

    return view('collections.index', compact('categories'));
}

    // Show products for a specific category
public function category($id)
{
    // Category info
    $category = Category::findOrFail($id);

    // Products belonging to this category
    $products = Product::where('category_id', $id)->paginate(12);

    // All categories (for sidebar)
    $categories = Category::all();

    // Return view with data
    return view('collections.category', compact('category', 'products', 'categories'));
}


public function show($id)
{
    $product = Product::findOrFail($id);

    // Categories fetch karna
    $categories = Category::all(); // ya jaisa bhi chahiye

    return view('products.show', compact('product', 'categories'));
}
// public function category($id)
// {
//     $category = Category::findOrFail($id);

//     $products = $category->products()->latest()->get();

//     return view('category-products', compact('category', 'products'));
// }


    public function viewCategoryById($id)
{
    // Fetch the category by ID
    $category = Category::findOrFail($id);

    // Get all products that belong to this category
    $products = Product::where('category_id', $category->id)->get();

    // Return the category products view
    return view('collections.products', compact('category', 'products'));
}




public function addProduct()
{
    return view('seller.products.create');
}

}