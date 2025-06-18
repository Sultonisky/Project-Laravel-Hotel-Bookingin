<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\ItemImage;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use App\Models\ItemStatusLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    // menampilkan halaman index item
    public function index()
    {
        // ambil data dari Model Item sekaligus dengan model User, Category, Images, Claims melalui relasi
        $items = Item::with(['user', 'category', 'claims'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.items.index', compact('items')); // buat view dan kirim data ke view
    }

    // untuk menampilkan form create
    public function create()
    {
        // ambil data dari model Category
        $categories = Category::all();
        return view('backend.items.create', compact('categories')); // buat view dan kirim data ke view
    }

    // untuk menyimpan data dan inputan di form create
    public function store(Request $request)
    {
        // validasi inputan di form create
        $validatedData = $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'nullable|string|max:255',
            'status' => 'required|in:tersedia,proses,didonasikan',
            'description' => 'nullable|string',
        ]);

        // jika input foro maka Simpan foto ke folder storage/img-items
        if ($request->hasFile('foto')) {
            // Simpan dan masukkan ke array validatedData
            $validatedData['foto'] = $request->file('foto')->store('img-items', 'public');
        }


        // Simpan item
        $validatedData['user_id'] = auth()->id(); // Jika ingin catat user yg buat
        $validatedData['status'] = 'tersedia';     // Atur default statusnya dengan tersedia

        // Simpan item ke DB jika lolos dari validasi
        Item::create($validatedData);

        // kembali ke halaman index dengan alert success
        return redirect()->route('backend.items.index')->with('success', 'Item berhasil disimpan!');
    }


    // untuk menampilkan detail item
    public function show(Item $item)
    {
        // ambil data dari model Category
        $categories = Category::all();
        return view('backend.items.show', compact('item', 'categories')); // buat view dan kirim data ke view
    }

    // untuk menampilkan form edit
    public function edit(Item $item)
    {
        // ambil data dari model Category
        $categories = Category::all();
        return view('backend.items.edit', compact('item', 'categories')); // buat view dan kirim data ke view
    }

    // untuk menyimpan data dan inputan di form edit
    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'nullable|string|max:255',
            'status' => 'required|in:tersedia,proses,didonasikan',
            'description' => 'nullable|string',
        ]);

        // Jika ada foto baru, hapus yang lama dan simpan yang baru
        if ($request->hasFile('foto')) {
            if ($item->foto && Storage::disk('public')->exists($item->foto)) {
                Storage::disk('public')->delete($item->foto);
            }

            // simpan path baru ke validatedData
            $validatedData['foto'] = $request->file('foto')->store('img-items', 'public');
        }

        $item->update($validatedData);

        return redirect()->route('backend.items.index')->with('success', 'Item berhasil diperbarui!');
    }




    // untuk menghapus item
    public function destroy(Item $item)
    {
        // hapus item dari DB 
        $item->delete();
        // kembali ke halaman index dengan alert success
        return redirect()->route('backend.items.index')->with('success', 'Barang berhasil dihapus.');
    }

    // public function showLogStatus(Item $item)
    // {
    //     $logs = ItemStatusLog::with('item')->latest('changed_at')->get();
    //     return view('backend.items.logStatus', compact('logs'));
    // }
}
