<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email'];
 //use App\Models\Customer;

public function index()
{
    $customers = Customer::all(); // or count(), paginate(), etc.

    return view('admin.dashboard', [
    'customers' => $customers
]);
}
}
