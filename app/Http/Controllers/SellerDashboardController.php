<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class SellerDashboardController extends Controller
{






    // Seller Dashboard
 public function index()
    {
        $user = Auth::user(); // logged-in seller

        // Fetch last 5 orders
        $orders = Order::where('seller_id', $user->id)
                        ->orderBy('created_at', 'desc')
                        ->limit(2)
                        ->get();

        // Fetch all notifications (or only unread)
        $notifications = $user->notifications; 
        // $notifications = $user->unreadNotifications;

        // Dashboard stats
        $data = [
            'total_sales'     => $orders->sum('total_amount'),
            'total_orders'    => Order::where('seller_id', $user->id)->count(),
            'total_products'  => Product::where('seller_id', $user->id)->count(),
        ];

        return view('seller.dashboard', compact('orders', 'notifications', 'data'));
    } // Profile Page
    public function profile()
    {
        $user = auth()->user();
        return view('seller.profile.edit', compact('user'));
    }

    // Update Profile
   public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // Redirect to seller dashboard with success message
    return redirect()->route('seller.dashboard')
                     ->with('success', 'Profile updated successfully.');
}

    // Change Password Page - GET
    public function changePassword()
    {
        return view('seller.profile.change-password');
    }
 public function orders()
    {
        $sellerId = Auth::id();

        // Use ->paginate() for pagination (or ->get() for all)
        $orders = Order::where('seller_id', $sellerId)
            ->with('user') // eager load user to avoid N+1
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }
    // Update Password - POST (FIXED)
    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'current_password' => ['required', 'current_password'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);

    //     auth()->user()->update([
    //         'password' => Hash::make($request->password)
    //     ]);

   
public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = auth()->user();

    // Check if current password matches
    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    // Update password
    $user->password = Hash::make($request->password);
    $user->save();

    // Redirect to Seller Dashboard after successful update
    return redirect()->route('seller.dashboard')
                     ->with('success', 'Password updated successfully.');
}
  public function customers()
    {
        // Fetch all users who are customers (assuming 'role' column exists)
        $customers = User::where('role', 'customer')->get();

        return view('seller.custumers.index', compact('customers'));
    }

     public function dashboard()
    {
        // Fetch any data you need for seller dashboard
        return view('seller.dashboard'); // resources/views/seller/dashboard.blade.php
    }
   
}
