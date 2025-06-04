<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('backend.profile.profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('backend.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'nama' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto) {
                Storage::delete('public/img-users/' . $user->foto);
            }

            $filename = time() . '.' . $request->foto->extension();
            $request->foto->storeAs('public/img-users', $filename);
            $user->foto = $filename;
        }

        $user->update([
            'nama' => $request->nama,
            'phone' => $request->phone,
            'address' => $request->address,
            'foto' => $user->foto ?? $user->foto,
        ]);

        return redirect()->route('backend.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
