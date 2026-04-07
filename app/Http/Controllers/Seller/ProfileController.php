<?php
namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
public function edit()
    {
        $user = auth()->user();

        if ($user->role === 'seller') {
            return view('seller.profile.edit');
        }

        if ($user->role === 'buyer') {
            return view('buyer.profile.edit');
        }

        // fallback
        return view('profile.edit');
    }

    public function index() {
        return view('seller.profile.index');
    }

    public function changePassword() {
        return view('seller.profile.change-password');
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

    $user = auth()->user();
    $user->password = bcrypt($request->password);
    $user->save();

    return back()->with('success', 'Password updated');
}
}