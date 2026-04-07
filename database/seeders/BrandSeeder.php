<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::insert([
            ['name' => 'Brand A'],
            ['name' => 'Brand B'],
            ['name' => 'Brand C'],
        ]);
    }
}
