<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
    use App\Models\Product;
      use App\Models\Brand;
class BrandController extends Controller
{


 public function show($slug)
    {
        // Slug ke through brand fetch karo
        $brand = Brand::with('products')->where('slug', $slug)->firstOrFail();

        $products = $brand->products;

        return view('brands.show', compact('brand', 'products'));
    }
    public function index()
    {
        $brands = [
            ['name'=>'Dhanuka','img'=>'dhanuka.png','slug'=>'dhanuka'],
            ['name'=>'Bayer','img'=>'bayer.jpg','slug'=>'bayer'],
            ['name'=>'Iffco','img'=>'iffco.png','slug'=>'iffco'],
            ['name'=>'Aries','img'=>'aries.jpg','slug'=>'aries'],
            ['name'=>'Sumitomo','img'=>'sumitomo.jpg','slug'=>'sumitomo'],
            ['name'=>'Syngenta','img'=>'syngenta.jpg','slug'=>'syngenta'],
            ['name'=>'UPL','img'=>'upl.png','slug'=>'upl'],
            ['name'=>'Yara','img'=>'yara.jpg','slug'=>'yara'],
            ['name'=>'Adama','img'=>'adama.jpg','slug'=>'adama'],
            ['name'=>'FMC','img'=>'fmc.png','slug'=>'fmc'],
            ['name'=>'Rallis','img'=>'rallis.jpg','slug'=>'rallis'],
            ['name'=>'BASF','img'=>'basf.png','slug'=>'basf'],
        ];

        return view('brands.index', compact('brands'));
    }

   
}