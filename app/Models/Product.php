<?php

namespace App\Models;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model

    {
    use HasFactory;

    protected $fillable = [
        'category_id', 'seller_id', 'name', 'slug', 'description',
        'sale_price', 'regular_price', 'stock', 'is_featured', 'image'
    ];

    protected $casts = [
        'sale_price' => 'decimal:2',
        'regular_price' => 'decimal:2',
        'images' => 'array',
    ];
    // app/Models/Product.php

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    // ✅ Check if on sale
    public function getIsOnSaleAttribute()
    {
        return $this->regular_price > $this->sale_price;
    }

    // ✅ Discount percentage
    public function getDiscountPercentageAttribute()
    {
        if ($this->regular_price > $this->sale_price) {
            return round((($this->regular_price - $this->sale_price) / $this->regular_price) * 100);
        }
        return 0;
    }

// app/Models/Product.php

public function brand() {
    return $this->belongsTo(Brand::class);
}


public function category()
{
    return $this->belongsTo(Category::class, 'category_id');
}
public function images()
{
    return $this->hasMany(ProductImage::class); 
}
}


