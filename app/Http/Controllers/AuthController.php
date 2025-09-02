<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DataTables;

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


    public function Users(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('full_name', fn($row) => $row->full_name ?? 'N/A')
                ->addColumn('gender', fn($row) => $row->gender ?? 'N/A')
                ->addColumn('date_of_birth', function ($row) {
                    return $row->date_of_birth ? \Carbon\Carbon::parse($row->date_of_birth)->format('d-m-Y') : 'N/A';
                })
                ->addColumn('phone_number', fn($row) => $row->phone_number ?? 'N/A')
                ->addColumn('address', fn($row) => $row->address ?? 'N/A')
                ->make(true);
        }
        return view('users.users');
    }
}
