<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\ItemImage;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['donor', 'category', 'images', 'claims'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('backend.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'main_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'nullable|string|max:255',
            // 'address' => 'nullable|string|max:255',
            // 'phone' => 'nullable|string|max:20',
            'status' => 'required|in:tersedia,proses,didonasikan',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('main_image')) {
            $filename = time() . '_' . uniqid() . '.' . $request->main_image->getClientOriginalExtension();
            $request->main_image->storeAs('public/img-items', $filename);
            $validatedData['main_image'] = $filename;
        }

        // Simpan item
        $validatedData['donor_id'] = auth()->id(); // Jika ingin catat donor
        $validatedData['status'] = 'tersedia';     // Atur default status

        Item::create($validatedData);

        return redirect()->route('backend.items.index')->with('success', 'Item berhasil disimpan!');
    }




    public function show(Item $item)
    {
        $categories = Category::all();
        return view('backend.items.show', compact('item', 'categories'));
    }

    public function edit(Item $item)
    {
        $categories = Category::all();
        return view('backend.items.edit', compact('item', 'categories'));
    }

    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'nullable|string|max:255',
            // 'address' => 'nullable|string|max:255',
            // 'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string',
        ]);

        if ($request->hasFile('main_image')) {
            $filename = time() . '_' . uniqid() . '.' . $request->main_image->getClientOriginalExtension();
            $request->main_image->storeAs('public/img-items', $filename);
            $validatedData['main_image'] = $filename;
        }

        $item->update($validatedData);

        return redirect()->route('backend.items.index')->with('success', 'Item berhasil diperbarui!');
    }



    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->route('backend.items.index')->with('success', 'Barang berhasil dihapus.');
    }
}
