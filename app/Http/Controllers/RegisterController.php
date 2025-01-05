<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registrationForm()
    {
        // dd(session()->all());

        return view('backend.v_register.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'hp' => 'required|string|max:13|unique:users',
        ]);

        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            // 'role' => 2, // default role user
            'status' => 1, // aktif
            'password' => Hash::make($validatedData['password']),
            'hp' => $validatedData['hp'],
        ]);

        // Redirect ke halaman login dengan pesan sukses
        // return redirect()->route('backend.login.view')->with('success', 'Registration successful. Please login.');

        session()->flash('success', 'Registration successful. Please login.');
        return view('backend.v_register.register'); // Load view langsung untuk debug
        // dd(session()->all());
        // return redirect()->route('backend.login.view')->with('success', 'Registration successful. Please login.');
        // session()->flash('success', 'Registration successful! Please login.');
        // return redirect()->route('backend.login.view');
    }
}
