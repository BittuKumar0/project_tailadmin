<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Assuming users table stores customers
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Fetch all users with their role
        $customers = User::select('id', 'name', 'email', 'role')->get();

        return view('admin.customers.index', compact('customers'));
    }
    public function update(Request $request, $id)
{
    $customer = User::findOrFail($id);

    $customer->update([
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
    ]);

    return redirect()->route('admin.customers.index')->with('success', 'Customer updated');
}
public function edit($id)
{
    $customer = User::findOrFail($id);
    return view('admin.customers.edit', compact('customer'));
}
public function destroy($id)
{
    if ($id == 1) {
        return back()->with('error', 'Admin cannot be deleted');
    }

    User::findOrFail($id)->delete();

    return back()->with('success', 'Customer deleted');
}
}