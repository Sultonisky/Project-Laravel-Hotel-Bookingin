<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Claim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // ✅ Tampilkan daftar klaim
    public function index()
    {
        $claims = Claim::with(['item', 'user'])->latest()->paginate(10);
        return view('backend.claims.index', compact('claims'));
    }

    // ✅ Form klaim item
    public function create()
    {
        $items = Item::where('donor_id', Auth::id())->get(); // hanya item milik user
        return view('backend.claims.create', compact('items'));
    }

    // ✅ Simpan klaim
    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'note' => 'nullable|string|max:1000',
        ]);

        Claim::create([
            'user_id' => Auth::id(),
            'item_id' => $request->item_id,
            'status' => 'pending', // default
            'note' => $request->note,
        ]);

        return redirect()->route('backend.claims.index')->with('success', 'Claim submitted successfully!');
    }

    // ✅ Detail klaim
    public function show(Claim $claim)
    {
        $claim->load(['item', 'user']);
        return view('backend.claims.show', compact('claim'));
    }

    // ✅ Form edit klaim
    public function edit(Claim $claim)
    {
        $this->authorize('update', $claim); // opsional: jika pakai policy
        $items = Item::where('donor_id', Auth::id())->get();
        return view('backend.claims.edit', compact('claim', 'items'));
    }

    // ✅ Update klaim
    public function update(Request $request, Claim $claim)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'note' => 'nullable|string|max:1000',
        ]);

        $claim->update([
            'item_id' => $request->item_id,
            'note' => $request->note,
        ]);

        return redirect()->route('backend.claims.index')->with('success', 'Claim updated.');
    }

    // ✅ Hapus klaim
    public function destroy(Claim $claim)
    {
        $this->authorize('delete', $claim); // opsional: jika pakai policy
        $claim->delete();
        return back()->with('success', 'Claim deleted.');
    }
}
