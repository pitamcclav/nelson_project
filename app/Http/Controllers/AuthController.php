<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Display login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Process login
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt to find the user
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Log in the user
            Auth::login($user);

            // Redirect to intended page or dashboard
            return redirect()->intended('dashboard');
        }

        // Return back with error if authentication fails
        return redirect()->back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Display registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Process registration
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed',
            'location'              => 'required|string|max:255',
            'phone'                 => 'required|string|max:255',
        ]);

        // Create user (assigning a default role, e.g., buyer)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'location' => $request->location,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
            'role'     => 'buyer', // adjust as needed
        ]);

        // Log in the new user
        Auth::login($user);

        // Redirect to dashboard
        return redirect()->route('dashboard');
    }

    // Log out the user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
