<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ])->validate();

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        // Redirect sesuai role
        if ($user->role === 'admin' || $user->role === 'donatur') {
            return redirect()->route('backend.dashboard');
        } else {
            return redirect()->route('beranda');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }
}
