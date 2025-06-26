<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginBackend()
    {
        return view('backend.v_login.login_new', [
            'judul' => 'Login Bookingin',
        ]);
    }

    public function authenticateBackend(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = \App\Models\User::where('email', $credentials['email'])->first();
        if (!$user) {
            return back()->with('error', 'Email is incorrect, please enter the correct email!');
        }

        if (!\Illuminate\Support\Facades\Hash::check($credentials['password'], $user->password)) {
            return back()->with('error', 'Password is incorrect, please enter the correct password!');
        }

        if ($user->status == 0) {
            return back()->with('error', 'User Status is Not Active!');
        }

        Auth::login($user);
        $request->session()->regenerate();

        // Redirect sesuai role
        if ($user->role === 1 || $user->role === 2) {
            return redirect()->route('backend.beranda'); // Admin & resepsionis
        } else {
            return redirect()->route('beranda'); // User biasa
        }
    }

    public function logoutBackend()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('backend.login.view');
    }
}
