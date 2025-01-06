<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Helpers\ImageHelper;
use App\Models\Guest;
use App\Models\RoomCategory;
use App\Models\RoomPhoto;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $room = Room::orderBy('updated_at', 'desc')->get();
        return view('backend.v_room.index', [
            'judul' => 'Rooms Data  ',
            'index' => $room
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roomCategory = RoomCategory::orderBy('category_name', 'asc')->get();
        // $guest = Guest::orderBy('nama', 'asc')->get();
        return view('backend.v_room.create', [
            'judul' => 'Add Room',
            'categories' => $roomCategory,
            // 'guests' => $guest
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'room_categories_id' => 'required',
            'room_name' => 'required|max:255|unique:rooms',
            'status' => 'required|boolean',
            'price' => 'required',
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ], $messages = [
            'foto.image' => 'Image formats use files with the extension jpeg, jpg, png, or gif.',
            'foto.max' => 'Maximum image file size is 1024 KB.'
        ]);

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-room/';

            // Simpan gambar asli 
            $fileName = ImageHelper::uploadAndResize($file, $directory, $originalFileName, null, null);
            $validatedData['foto'] = $fileName;

            // create thumbnail 1 (lg) 
            $thumbnailLg = 'thumb_lg_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailLg, 800, null);

            // create thumbnail 2 (md) 
            $thumbnailMd = 'thumb_md_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailMd, 500, 519);

            // create thumbnail 3 (sm) 
            $thumbnailSm = 'thumb_sm_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailSm, 100, 110);
            // Simpan nama file asli di database 
            $validatedData['foto'] = $originalFileName;
        }
        // dd($request);
        Room::create($validatedData, $messages);
        return redirect()->route('backend.room.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $room = Room::with('photos')->findOrFail($id);
        $roomCategory = RoomCategory::orderBy('category_name', 'asc')->get();
        return view('backend.v_room.show', [
            'judul' => 'Detail Room',
            'show' => $room,
            'categories' => $roomCategory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::findOrFail($id);
        $roomCategory = RoomCategory::orderBy('category_name', 'asc')->get();
        return view('backend.v_room.edit', [
            'judul' => 'Edit This Room',
            'edit' => $room,
            'categories' => $roomCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $room = Room::findOrFail($id);
        $rules = [
            'room_name' => 'required|max:255|unique:rooms,room_name,' . $id,
            // 'room_categories_id' => 'required|unique:room_categories,category_name,' . $id,
            'room_categories_id' => 'required|exists:room_categories,id',
            'status' => 'required|boolean',
            // 'detail' => 'required',
            'price' => 'required',
            // 'number_of_rooms' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ];
        $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ];
        $validatedData = $request->validate($rules, $messages);

        if ($request->file('foto')) {
            //hapus gambar lama 
            if ($room->foto) {
                $oldImagePath = public_path('storage/img-room/') . $room->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
                $oldThumbnailLg = public_path('storage/img-room/') . 'thumb_lg_' .
                    $room->foto;
                if (file_exists($oldThumbnailLg)) {
                    unlink($oldThumbnailLg);
                }
                $oldThumbnailMd = public_path('storage/img-room/') . 'thumb_md_' .
                    $room->foto;
                if (file_exists($oldThumbnailMd)) {
                    unlink($oldThumbnailMd);
                }
                $oldThumbnailSm = public_path('storage/img-room/') . 'thumb_sm_' .
                    $room->foto;
                if (file_exists($oldThumbnailSm)) {
                    unlink($oldThumbnailSm);
                }
            }
            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $originalFileName = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $directory = 'storage/img-room/';

            // Simpan gambar asli 
            $fileName = ImageHelper::uploadAndResize($file, $directory, $originalFileName, null, null);
            $validatedData['foto'] = $fileName;

            // create thumbnail 1 (lg) 
            $thumbnailLg = 'thumb_lg_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailLg, 800, null);
            // create thumbnail 2 (md) 
            $thumbnailMd = 'thumb_md_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailMd, 500, 519);

            // create thumbnail 3 (sm) 
            $thumbnailSm = 'thumb_sm_' . $originalFileName;
            ImageHelper::uploadAndResize($file, $directory, $thumbnailSm, 100, 110);

            // Simpan nama file asli di database 
            $validatedData['foto'] = $originalFileName;
        }

        $room->update($validatedData);
        return redirect()->route('backend.room.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $room = Room::findOrFail($id);
        $directory = public_path('storage/img-room/');

        if ($room->foto) {
            // Hapus gambar asli 
            $oldImagePath = $directory . $room->foto;
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Hapus thumbnail lg 
            $thumbnailLg = $directory . 'thumb_lg_' . $room->foto;
            if (file_exists($thumbnailLg)) {
                unlink($thumbnailLg);
            }

            // Hapus thumbnail md 
            $thumbnailMd = $directory . 'thumb_md_' . $room->foto;
            if (file_exists($thumbnailMd)) {
                unlink($thumbnailMd);
            }
            // Hapus thumbnail sm 
            $thumbnailSm = $directory . 'thumb_sm_' . $room->foto;
            if (file_exists($thumbnailSm)) {
                unlink($thumbnailSm);
            }
        }
        // Hapus foto produk lainnya di tabel foto_produk 
        $fotoRooms = RoomPhoto::where('rooms_id', $id)->get();
        foreach ($fotoRooms as $fotoRoom) {
            $fotoPath = $directory . $fotoRoom->foto;
            if (file_exists($fotoPath)) {
                unlink($fotoPath);
            }
            $fotoRoom->delete();
        }

        $room->delete();

        return redirect()->route('backend.room.index')->with('success', 'Data Deleted Successfully');
    }

    public function storeFoto(Request $request)
    {
        // Validasi input 
        $request->validate([
            'rooms_id' => 'required|exists:rooms,id',
            'foto_rooms.*' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024',
        ]);
        if ($request->hasFile('foto_rooms')) {
            foreach ($request->file('foto_rooms') as $file) {
                // Buat nama file yang unik 
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHis') . '_' . uniqid() . '.' . $extension;
                $directory = 'storage/img-room/';

                // Simpan dan resize gambar menggunakan ImageHelper 
                ImageHelper::uploadAndResize($file, $directory, $filename, 800, null);
                // Simpan data ke database 
                RoomPhoto::create([
                    'rooms_id' => $request->rooms_id,
                    'foto' => $filename,
                ]);

                // dd($request);
                // dd($request->all());
            }
        }
        return redirect()->route('backend.room.show', $request->rooms_id)->with('success', 'Photo Added Successfully.');
    }

    // Method untuk menghapus foto 
    public function destroyFoto($id)
    {
        $foto = RoomPhoto::findOrFail($id);
        $roomId = $foto->rooms_id;

        // Hapus file gambar dari storage 
        $imagePath = public_path('storage/img-room/') . $foto->foto;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        // Hapus record dari database 
        $foto->delete();

        return redirect()->route('backend.room.show', $roomId)->with('success', 'Photo Deleted Successfully.');
    }

    public function roomGallery()
    {
        return view('backend.v_room.gallery');
    }
}
