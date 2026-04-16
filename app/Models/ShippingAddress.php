<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ShippingAddress extends Model
{
    use HasFactory;


    protected $table = 'shipping_addresses';

  
   protected $fillable = [
        'user_id', 'full_name', 'phone', 'email', 'address', 'city', 'state', 'pincode'
    ];

 public function orders()
{
    return $this->hasMany(Order::class, 'shipping_id');
}
public function showForm()
{
    return view('checkout.shipping');
}
public function user()
{
    return $this->belongsTo(\App\Models\User::class);
}
}