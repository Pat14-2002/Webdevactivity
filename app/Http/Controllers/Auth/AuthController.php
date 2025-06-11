<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            Session::put('loginId', $user->id);
            return redirect()->route('users.index')->with('success', 'Login successful'); // Fixed redirect
        }

        return back()->with('fail', 'Email or password is incorrect');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::forget('loginId');

        $request->session()->invalidate(); // Ensures session is cleared
        $request->session()->regenerateToken(); // Security improvement

        return redirect()->route('auth.index')->with('success', 'Logout successful');
    }

    /**
     * Fix PUT Method Error: Ensure the update method routes correctly
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); // Ensure user ID is fetched correctly

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
}
