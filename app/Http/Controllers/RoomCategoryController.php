<?php

namespace App\Http\Controllers;

use App\Models\RoomCategory;
use Illuminate\Http\Request;

class RoomCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = RoomCategory::orderBy('category_name', 'asc')->get();
        return view('backend.v_category.index', [
            'judul' => 'Kategori',
            'index' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.v_category.create', [
            'judul' => 'Category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request); 
        $validatedData = $request->validate([
            'category_name' => 'required|max:255|unique:room_categories',
            'number_of_rooms' => 'required|integer',
            'description' => 'required|max:255',
        ]);
        RoomCategory::create($validatedData);
        return redirect()->route('backend.category.index')->with('success', 'Data Saved Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = RoomCategory::find($id);
        return view('backend.v_category.edit', [
            'judul' => 'Category',
            'edit' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'category_name' => 'required|max:255|unique:room_categories,category_name,' . $id,
            'number_of_rooms' => 'required|integer',
            'description' => 'required|max:255',
        ];
        $validatedData = $request->validate($rules);
        RoomCategory::where('id', $id)->update($validatedData);
        return redirect()->route('backend.category.index')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = RoomCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('backend.category.index')->with('success', 'Data Deleted Successfully');
    }
}
