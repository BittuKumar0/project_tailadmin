<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    public function run(): void {
        Product::insert([
            ['name'=>'iPhone 15','price'=>120000,'description'=>'Latest Apple iPhone','image'=>'https://via.placeholder.com/150'],
            ['name'=>'Samsung Galaxy S24','price'=>80000,'description'=>'Latest Samsung phone','image'=>'https://via.placeholder.com/150'],
            ['name'=>'Dell Laptop','price'=>65000,'description'=>'Powerful laptop','image'=>'https://via.placeholder.com/150'],
            ['name'=>'Sony Headphones','price'=>5000,'description'=>'Noise cancelling headphones','image'=>'https://via.placeholder.com/150'],
        ]);
    }
}