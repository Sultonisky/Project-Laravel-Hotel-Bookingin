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

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status == 0) {
                Auth::logout();
                return back()->with('error', 'User Status is Not Active!');
            }

            $request->session()->regenerate();

            // Redirect sesuai role
            if ($user->role === 1 || $user->role === 2) {
                return redirect()->route('backend.beranda'); // Admin & resepsionis
            } else {
                return redirect()->route('beranda'); // User biasa
            }
        }

        return back()->with('error', 'Incorrect email or password');
    }

    public function logoutBackend()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('backend.login.view');
    }
}
