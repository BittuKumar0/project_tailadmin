<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class ProfileController extends Controller
{



   public function edit(Request $request)
{
    $user = $request->user();
    return view('profile.edit', compact('user'));
}

public function update(Request $request)
{
    $user = $request->user();

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
    ]);

    $user->update($request->only('name', 'email'));

    return redirect()->route('profile.edit')->with('status', 'Profile updated!');
}
  

public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'password' => 'required|min:6|confirmed',
    ]);

    $user = auth()->user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->with('error', 'Current password is incorrect');
    }

    $user->update([
        'password' => Hash::make($request->password)
    ]);

    return back()->with('success', 'Password updated successfully');
}
    public function editPassword()
{
    return view('profile.password_update');
}
}