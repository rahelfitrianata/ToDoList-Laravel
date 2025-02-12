<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function store(Request $request)
    {
    $request->validate([
        'username' => 'required|string|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hash password sebelum disimpan
    ]);

    return redirect()->route('login')->with('success', 'Account created successfully!');
    }

    public function authenticate(Request $request)
    {
    $credentials = $request->validate([
        'username' => 'required|string', 
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        return redirect()->route('dashboard');
    }

    return back()->withErrors(['username' => 'Invalid credentials']);
    }
    
}
