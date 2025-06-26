<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guest = Guest::orderBy('updated_at', 'desc')->get();
        return view('backend.v_guest.index', [
            'judul' => 'Guest Data',
            'index' => $guest
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_guest.create', [
            'judul' => 'Add Guest',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:guests,email',
            'no_hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|max:1024',
        ], [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar maksimal adalah 1024 KB.'
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);

            $validatedData['foto'] = $originalFileName;
        }

        Guest::create($validatedData);
        return redirect()->route('backend.guest.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guest = Guest::findOrFail($id);

        return view('backend.v_guest.show', [
            'judul' => 'Detail Guest',
            'guest' => $guest
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $guest = Guest::findOrFail($id);
        return view('backend.v_guest.edit', [
            'judul' => 'Edit Guest',
            'edit' => $guest,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $guest = Guest::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:guests,email,' . $id,
            'no_hp' => 'required|min:10|max:13',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|max:1024',
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-user/';
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400);

            // Hapus gambar lama
            if ($guest->foto && file_exists(public_path($directory . $guest->foto))) {
                unlink(public_path($directory . $guest->foto));
            }

            $validatedData['foto'] = $originalFileName;
        }

        $guest->update($validatedData);
        return redirect()->route('backend.guest.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $guest = Guest::findOrFail($id);
        $directory = 'storage/img-user/';

        // Hapus gambar terkait
        if ($guest->foto && file_exists(public_path($directory . $guest->foto))) {
            unlink(public_path($directory . $guest->foto));
        }

        $guest->delete();
        return redirect()->route('backend.guest.index')->with('success', 'Data Deleted Successfully');
    }

    /**
     * Tampilkan data tamu yang sudah dihapus (soft delete)
     */
    public function trashed()
    {
        $trashed = Guest::onlyTrashed()->get();
        return view('backend.v_guest.trashed', [
            'judul' => 'Trashed Guests',
            'trashed' => $trashed,
        ]);
    }

    /**
     * Restore data tamu yang sudah dihapus (soft delete)
     */
    public function restore($id)
    {
        $guest = Guest::onlyTrashed()->findOrFail($id);
        $guest->restore();
        return redirect()->route('backend.guest.trashed')->with('success', 'Data tamu berhasil dipulihkan!');
    }
}
