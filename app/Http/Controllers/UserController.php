<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Store a new user in the database
     */
    public function store(Request $request) // Changed method name to match route
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('users.index')->with('success', 'User has been added successfully!');
    }

    /**
     * Update an existing user
     */
    public function update(Request $request, $id) // Ensure `$id` is received properly
    {
        $user = User::findOrFail($id); // Find user by ID

        $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|min:8'
        ]);
        
        $user->update([
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password
        ]);

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Delete a user from the database
     */
    public function destroy($id) // Changed method name to match Laravel convention
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User has been deleted successfully!');
    }
}
