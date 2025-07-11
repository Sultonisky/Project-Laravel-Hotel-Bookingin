<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::orderBy('updated_at', 'desc')->get();
        return view('backend.v_user.index', [
            'judul' => 'Users Data',
            'index' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_user.create', [
            'judul' => 'Tambah User',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:4|confirmed',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ], $messages = [
            'foto.image' => 'Image formats use files with the extension jpeg, jpg, png, or gif.',
            'foto.max' => 'Maximum image file size is 1024 KB.'
        ]);
        $validatedData['status'] = 0;

        // menggunakan ImageHelper 
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';
            // Simpan gambar dengan ukuran yang ditentukan 
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); // null (jika tinggi otomatis) 
            // Simpan nama file asli di database 
            $validatedData['foto'] = $originalFileName;
        }

        // password kombinasi  
        $password = $request->input('password');
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        // huruf kecil ([a-z]), huruf besar ([A-Z]), dan angka (\d) (?=.*[\W_]) simbol karakter (non-alphanumeric) 
        if (preg_match($pattern, $password)) {
            $validatedData['password'] = Hash::make($validatedData['password']);
            User::create($validatedData, $messages);
            return redirect()->route('backend.user.index')->with('success', 'Data Saved Successfully');
        } else {
            return redirect()->back()->withErrors(['password' => 'The password must consist of a combination of uppercase letters, lowercase letters, numbers and character symbols.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.v_user.show', [
            'judul' => 'show User',
            'show' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('backend.v_user.edit', [
            'judul' => 'Edit User',
            'edit' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($requst)
        $user = User::findOrFail($id);
        $rules = [
            'name' => 'required|max:255',
            'role' => 'required',
            'status' => 'required',
            'foto' => 'image|mimes:jpeg,jpf,png,gif|file|max:1024',
        ];
        $messages = [
            'foto.image' => 'Image formats use files with the extension jpeg, jpg, png, or gif.'
        ];

        if ($request->email != $user->email) {
            $rules['email'] = 'required|max:255|email|unique:user';
        }

        $validatedData = $request->validate($rules, $messages);

        // menggunakan ImageHelper
        if ($request->file('foto')) {
            // hapus gambar lama
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('ymdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); // null (jika tinggi otomatis) 
            // Simpan nama file asli di database 
            $validatedData['foto'] = $originalFileName;
        }
        $user->update($validatedData);
        return redirect()->route('backend.user.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = user::findOrFail($id);
        if ($user->foto) {
            $oldImagePath = public_path('storage/img-user/') . $user->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $user->delete();
        return redirect()->route('backend.user.index')->with('success', 'Data Deleted Successfully');
    }

    /**
     * Tampilkan data user yang sudah dihapus (soft delete)
     */
    public function trashed()
    {
        $trashed = User::onlyTrashed()->get();
        return view('backend.v_user.trashed', [
            'judul' => 'Trashed Users',
            'trashed' => $trashed,
        ]);
    }

    /**
     * Restore data user yang sudah dihapus (soft delete)
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('backend.user.trashed')->with('success', 'Data user berhasil dipulihkan!');
    }
}
