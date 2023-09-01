<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm(){
        return view('login');
    }


    public function login(Request $request)
    {
    $credentials = $request->only('email', 'password');
    
    if (Auth::attempt($credentials)) {
        // Authentication passed
        
        $user = Auth::user(); // Get the authenticated user

        // Determine where to redirect based on the user's role
        if ($user->role === 'admin') {
            return redirect()->route('admin.index')->with('message', 'Logged in successfully as admin!');
        } elseif ($user->role === 'client') {
            return redirect()->route('client.index')->with('message', 'Logged in successfully as client!');
        } elseif ($user->role === 'technician') {
            return redirect()->route('technician.index')->with('message', 'Logged in successfully as technician!');
        }
        
    }
    
    return back()->with('error', 'Please Enter Valid Email and Password');
    }
}
