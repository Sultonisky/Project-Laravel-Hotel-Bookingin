<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use App\Models\Feature;
use App\Models\RoomPhoto;
use App\Helpers\ImageHelper;
use App\Models\RoomCategory;
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
        $roomCategory = RoomCategory::where('number_of_rooms', '>', 0)->orderBy('category_name', 'asc')->get();
        $features = Feature::all(); // ambil semua fitur
        // $guest = Guest::orderBy('nama', 'asc')->get();
        return view('backend.v_room.create', [
            'judul' => 'Add Room',
            'categories' => $roomCategory,
            'features' => $features
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
            'features' => 'array|nullable', // fitur boleh kosong
            'features.*' => 'exists:features,id',
            'foto' => 'required|image|mimes:jpeg,jpg,png,gif|file|max:10024',
        ], $messages = [
            'foto.image' => 'Image formats use files with the extension jpeg, jpg, png, or gif.',
            'foto.max' => 'Maximum image file size is 10024 KB.'
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
        $room = Room::create($validatedData, $messages);
        // Simpan fitur ke room
        if ($request->has('features')) {
            $room->features()->attach($request->features);
        }
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
        $features = Feature::all();
        $roomCategory = RoomCategory::where('number_of_rooms', '>', 0)->orderBy('category_name', 'asc')->get();
        return view('backend.v_room.edit', [
            'judul' => 'Edit This Room',
            'edit' => $room,
            'features' => $features,
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
            'room_categories_id' => 'required|exists:room_categories,id',
            'status' => 'required|boolean',
            'price' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png,gif|file|max:10024',
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
        $room->features()->sync($request->input('features', []));
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
        $fotoRooms = RoomPhoto::where('room_id', $id)->get();
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
            'room_id' => 'required|exists:rooms,id',
            'foto_rooms.*' => 'image|mimes:jpeg,jpg,png,gif|file|max:10024',
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
                    'room_id' => $request->room_id,
                    'foto' => $filename,
                ]);



                // dd($request);
                // dd($request->all());
            }
        }
        return redirect()->route('backend.room.show', $request->room_id)->with('success', 'Photo Added Successfully.');
    }

    // Method untuk menghapus foto 
    public function destroyFoto($id)
    {
        $foto = RoomPhoto::findOrFail($id);
        $roomId = $foto->room_id;

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

    public function room_detail($id)
    {
        $room = Room::with('photos', 'features')->findOrFail($id);
        return view('frontend.v_room_details.detail_room', compact('room'));
    }

    // public function roomCategory($id)
    // {
    //     $category = RoomCategory::orderBy('category_name', 'desc')->get();
    //     $room = Room::where('room_categories_id', $id)->where('status', 0)
    //         ->orderBy('updated_at', 'desc')->paginate(6);
    //     return view('v_room.roomCategory', [
    //         'title' => 'Filter category',
    //         'category' => $category,
    //         'room' => $room,
    //     ]);
    // }

    // public function roomAll()
    // {
    //     $category = roomCategory::orderBy('category_name', 'desc')->get();
    //     $room = Room::where('status', 1)->orderBy('updated_at', 'desc')->paginate(6);
    //     return view('v_room.index', [
    //         'title' => 'Room All',
    //         'category' => $category,
    //         'room' => $room,
    //     ]);
    // }

    /**
     * Tampilkan data kamar yang sudah dihapus (soft delete)
     */
    public function trashed()
    {
        $trashed = Room::onlyTrashed()->get();
        return view('backend.v_room.trashed', [
            'judul' => 'Trashed Rooms',
            'trashed' => $trashed,
        ]);
    }

    /**
     * Restore data kamar yang sudah dihapus (soft delete)
     */
    public function restore($id)
    {
        $room = Room::onlyTrashed()->findOrFail($id);
        $room->restore();
        return redirect()->route('backend.room.trashed')->with('success', 'Data kamar berhasil dipulihkan!');
    }
}
