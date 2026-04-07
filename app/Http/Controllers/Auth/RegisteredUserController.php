<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show registration page.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate input
      $request->validate([
    'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
    'email' => ['required', 'email', 'string', 'max:255', 'unique:users,email'],
    'password' => ['required', 'confirmed', Rules\Password::defaults()],
    'role' => ['required', 'in:buyer,seller'], // only buyer or seller
], [
    'name.required' => 'Name is required.',
    'name.regex' => 'Name can only contain letters and spaces.',
    'email.required' => 'Email is required.',
    'email.email' => 'Enter a valid email address.',
    'email.unique' => 'This email is already registered.',
    'password.required' => 'Password is required.',
    'password.confirmed' => 'Passwords do not match.',
    'role.required' => 'Please select a role.',
    'role.in' => 'Invalid role selected.'
]);

        // Determine role
        $role = $request->role;

        // First user is automatically admin
        if(User::count() === 0){
            $role = 'admin';
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role
        ]);

        // Fire registered event
        event(new Registered($user));

        return redirect()->route('login')->with('success', 'Registration successful! You can now login.');
    }
}