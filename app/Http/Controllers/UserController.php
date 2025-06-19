<?php

namespace App\Http\Controllers;

use App\Models\User;
<<<<<<< HEAD
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
=======
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
>>>>>>> 3d9f03e28f0f29b18fa29872119da2dbd9d6154d
    }
}
