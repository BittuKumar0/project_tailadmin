<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Allow mass assignment for name (optional)
 

    protected $fillable = ['name', 'slug', 'img'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
    


