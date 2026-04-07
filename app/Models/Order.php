<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Order extends Model
{
    use HasFactory;

protected $fillable = [
    'order_id',          // varchar(50) - e.g., ORD-123
    'seller_id',         // bigint
    'user_id',           // bigint
    'product_id',        // bigint
    'product_name',      // text
    'quantity',          // int
    'price',             // decimal
    'total',             // decimal
    'name',              // varchar(255) - Customer Name
    'shipping_id',       // bigint (NOT NULL in DB)
    'email',             // varchar(255)
    'phone',             // varchar(20) - Ensure this matches DB column 'phone'
    'address',           // text
    'payment_status',    // varchar(50)
    'payment_method',    // varchar(50)
    'status',            // varchar(50)
    'stripe_payment_id'  // varchar(255) - Stripe Transaction ID
];


    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }
    
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
public function products()
{
    return $this->belongsToMany(Product::class)
                ->withPivot('quantity')
                ->withTimestamps();
}
    public function buyer()
    {
        return $this->belongsTo(User::class,'buyer_id');
    }
public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id'); // Seller
    }
// app/Models/User.php
public function orderItems()
{
    return $this->hasMany(\App\Models\OrderItem::class, 'order_id', 'id');
}
   public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

public function images()
{
    return $this->hasMany(ProductImage::class);
}

public function reviews()
{
    return $this->hasMany(ProductReview::class);
}
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation to order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

// public function shipping()
// {
    
//     return $this->belongsTo(ShippingAddress::class, 'shipping_id');
// }
public function shippingAddress()
{
    return $this->belongsTo(ShippingAddress::class, 'shipping_id');
}
  



  // ... existing code ...

    /**
     * The products that belong to the order.
     */

    /**
     * Relationship with the user who placed the order
     */
 
}





