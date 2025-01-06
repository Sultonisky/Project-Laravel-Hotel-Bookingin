<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function registrationForm()
    {
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
            'status' => 1, // aktif
            'password' => Hash::make($validatedData['password']),
            'hp' => $validatedData['hp'],
        ]);
        session()->flash('success', 'Registration successful. Please login.');
        return view('backend.v_register.register'); // Load view langsung untuk debug
    }
}
