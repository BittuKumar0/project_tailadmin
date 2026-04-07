<?php
namespace App\Http\Controllers;
  use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class ShippingController extends Controller
{
  
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:20',
        ]);

        $shipping = ShippingAddress::create([
            'user_id' => Auth::id(),
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
        ]);

        // Redirect to payment page with shipping ID
        return redirect()->route('checkout.payment', ['shipping_id' => $shipping->id]);
    }
  

public function showForm()
{
    $categories = Category::all(); // ya jo categories chahiye

    return view('checkout.shipping', compact('categories'));
}
}