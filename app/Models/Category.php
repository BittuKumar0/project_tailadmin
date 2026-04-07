<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

public function images()
{
    return $this->hasMany(ProductImage::class);
}


public function create()
{
    $categories = Category::all();

    return view('seller.products.create', compact('categories'));
}
public function products()
{
    return $this->hasMany(Product::class);
}
}
