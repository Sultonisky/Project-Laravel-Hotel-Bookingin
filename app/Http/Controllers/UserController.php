<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Tampilkan semua user
    public function index() // buat manggil tampilan index 
    {
        $users = User::latest()->get(); // ambil model User/tabel users di DB untuk ditampilkan
        return view('backend.users.index', compact('users')); // buat view yg menampilkan data dari model User
    }

    public function penerima() // tampilkan user dengan role penerima
    {
        // ambil dari Model/table users di DB yg rolenya penerima
        $users = User::where('role', 'penerima')->get();
        // view untuk penerima dan ambil data di model User tadi
        return view('backend.penerima.index', compact('users'));
    }

    // Tampilkan form create
    public function create() // untuk menampilkan form create untuk tabel users
    {
        return view('backend.users.create'); // buat tampilannya di view yg berisi form untuk create users
    }

    // Simpan user baru
    public function store(Request $request) // buat simpan data dari form yg tadi sudah diisi
    {
        // buat validasi dari form create tsb (kalo nama maksimalnya brp, email harus berbeda 1 sama lain, gambar harus jpg,jpeg dll)
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string',
            'role' => 'required|in:penerima,donatur',
            'address' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // jika users masukkan foto di form create maka akan disimpan di folder storage/img-users
        // dan nama di DB dibuat berbeda 1 sama lain
        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('img-users', 'public');
        }



        // password otomatis dibuat hash di DB (agar tidak diketahui bahkan user admin)
        $validated['password'] = Hash::make($validated['password']);

        // jika validasinya lolos semua maka simpan data users dari form yg disubmit ke DB
        User::create($validated);

        // lalu redirect ke halaman index dengan alert success
        return redirect()->route('backend.users.index')->with('success', 'User berhasil ditambahkan.');
    }


    // Tampilkan detail user
    public function show(User $user)
    {
        return view('backend.users.show', compact('user')); // buat tampilan di view yg ambil data dari model User di DB
    }

    // Tampilkan form edit
    public function edit(User $user)
    {
        // buat tampilan form edit di view yg ambil data dari model User di DB
        return view('backend.users.edit', compact('user'));
    }

    // Update user
    public function update(Request $request, User $user)
    {
        // buat validasi dari form create tsb (kalo nama maksimalnya brp, email harus berbeda 1 sama lain, gambar harus jpg,jpeg dll)
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|string|min:6',
        ]);

        // jika users masukkan foto baru di form edit maka akan disimpan di folder storage/img-users
        // dan nama di DB dibuat berbeda 1 sama lain
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $validated['foto'] = $request->file('foto')->store('img-users', 'public');
        }



        // validasi password yg dimasukkkan jika 
        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        // // jika validasinya lolos semua maka simpan data users yg baru dari form yg disubmit ke DB
        $user->update($validated);

        // lalu redirect ke halaman index dengan alert success
        return redirect()->route('backend.users.index')->with('success', 'User berhasil diperbarui.');
    }


    // Hapus user
    public function destroy(User $user)
    {
        // jika user punya foto maka hapus foto tsb
        if ($user->foto) {
            Storage::disk('public')->delete($user->foto);
        }
        $user->delete();
        // lalu redirect ke halaman index dengan alert success
        return redirect()->route('backend.users.index')->with('success', 'User berhasil dihapus.');
    }


    // menampilkan view profile untuk admin di dashboard
    public function profile()
    {
        $user = auth()->user(); // ambil data dari admin yg login
        return view('backend.profile.profile', compact('user')); // view untuk proile dan ambil data dari admin yg login
    }

    // form untuk admin edit profilenya
    public function editProfile()
    {
        $user = auth()->user(); // ambil data dari admin yg login
        return view('backend.profile.edit', compact('user')); // view untuk edit profile admin dan ambil data dari admin yg login
    }

    // update untuk admin yg edit profile
    public function updateProfile(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        $request->validate([
            'nama' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'nama' => $request->nama,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $data['foto'] = $request->file('foto')->store('img-users', 'public');
        }

        $user->update($data);

        return redirect()->route('backend.profile.show')->with('success', 'Profil berhasil diperbarui.');
    }
}
