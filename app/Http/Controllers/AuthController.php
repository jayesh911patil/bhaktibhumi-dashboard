<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function Adminogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('login');
    }

    public function Login(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->filled('remember');

        $credentials = ['email' => $request->email, 'password' => $request->password];

        $user = \App\Models\User::where('email', $request->email)->first();

        if (Auth::attempt($credentials, $remember)) {

            return redirect()->route('dashboard')->with('success', 'Login Successfully');
        } else {
            return redirect()->route('admin')->with('error', 'Username or Password is Incorrect');
        }
    }

    public function Logout()
    {
        Auth::logout();
        // Invalidate the session and regenerate the CSRF token
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin')->with('success', 'Logged out successfully');
    }
}
