<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() // method index untuk menampilkan data
    {
        $categories = Category::latest()->get();
        return view('backend.categories.index', compact('categories'));
    }

    public function create() // untuk tampilan form create
    {
        return view('backend.categories.create'); // buat tampilan form create untuk category
    }

    public function store(Request $request) // untuk menyimpan data / submit ke DB
    {
        // validasi dahulu
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
        ]);

        // jika lolos validasi maka data yg di submit dari form create akan disimpan ke DB
        Category::create([
            'name' => $request->name,
        ]);

        //lalu redirect ke halaman index dengan alert success
        return redirect()->route('backend.categories.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    //untuk menampikan detail categorynya
    public function show($id)
    {
        // ambil data model Category berdasarkan idnya
        $category = Category::findOrFail($id);

        // buat view yg ngambil data dari model Category untuk menampilkan detail dari category
        return view('backend.categories.show', compact('category'));
    }

    // form untuk edit data category
    public function edit($id)
    {
        // ambil data model Category berdasarkan idnya
        $category = Category::findOrFail($id);

        // buat view yg ngambil data dari model Category untuk menampilkan detail dari category
        return view('backend.categories.edit', compact('category'));
    }

    // jika form disubmit maka data akan di simpan
    public function update(Request $request, $id)
    {
        // ambil data model Category berdasarkan idnya
        $category = Category::findOrFail($id);

        // validasi inputan di form create
        $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
        ]);

        // jika inputannya lolos validasi maka data akan disimpan di DB
        $category->update([
            'name' => $request->name,
        ]);

        // lalu redirect ke halaman index dengan alert success
        return redirect()->route('backend.categories.index')->with('success', 'Kategori berhasil diperbarui');
    }

    // untuk menghapus data category
    public function destroy($id)
    {
        // ambil data model Category berdasarkan idnya
        $category = Category::findOrFail($id);
        // jika ada datanya maka hapus
        $category->delete();

        // lalu redirect ke halaman index dengan alert success
        return redirect()->route('backend.categories.index')->with('success', 'Kategori berhasil dihapus');
    }
}
