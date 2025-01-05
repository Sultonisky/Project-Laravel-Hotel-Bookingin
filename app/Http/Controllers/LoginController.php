<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginBackend()
    {
        return view('backend.v_login.login', [
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
            if (Auth::user()->status == 0) {
                Auth::logout();
                return back()->with('error', 'User Status is Not Active!');
            }
            $request->session()->regenerate();
            return redirect()->intended(route('backend.beranda'));
        }
        return back()->with('error', 'Incorrect email or password');
    }

    public function logoutBackend()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect(route('backend.login.view'));
    }
}
