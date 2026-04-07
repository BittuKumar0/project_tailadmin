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
        $user = $request->user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match']);
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile.edit')->with('status_password', 'Password updated!');
    }
}