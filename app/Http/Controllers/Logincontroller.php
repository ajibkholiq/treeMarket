<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logincontroller extends Controller
{
    // Display the login form
    // Handle the login attempt
    public function login(Request $request)
    {
        // Validate the form data
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Authentication passe
            return redirect()->intended('admin/barang'); // Redirect to the intended page after successful login
        } else {
            // Authentication failed
            return back()->with('error', 'Invalid credentials. Please try again.');
        }
    }

    // Log the user out
    public function logout()
    {
        Auth::logout();
        return redirect('admin/');
    }
}
