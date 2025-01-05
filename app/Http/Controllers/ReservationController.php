<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservation = Reservation::orderBy('updated_at', 'desc')->get();
        return view('backend.v_reservation.index', [
            'judul' => 'Reservation Data',
            'index' => $reservation
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data tamu, diurutkan berdasarkan nama
        $guest = Guest::orderBy('name', 'asc')->get();

        // Ambil hanya kamar yang berstatus Ready dan kategori dengan jumlah kamar > 0
        $room = Room::where('status', 1) // Filter kamar dengan status "Ready"
            ->whereHas('category', function ($query) {
                $query->where('number_of_rooms', '>', 0); // Filter kategori dengan kamar yang tersedia
            })
            ->orderBy('room_name', 'asc') // Urutkan berdasarkan nama kamar
            ->get();

        // Kirim data ke view
        return view('backend.v_reservation.create', [
            'judul' => 'Add Reservation Data',
            'guests' => $guest,
            'rooms' => $room,
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'guests_id' => 'required|exists:guests,id',
            'rooms_id' => 'required|exists:rooms,id',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
            'payment_method' => 'required|boolean',
        ]);


        $validatedData['created_by'] = auth()->user()->id;
        $validatedData['updated_by'] = auth()->user()->id;

        // Ambil data kamar berdasarkan rooms_id
        $room = Room::findOrFail($request->rooms_id);

        // Ambil kategori kamar terkait
        $category = RoomCategory::findOrFail($room->room_categories_id);

        // Menghitung total pembayaran
        $room = Room::findOrFail($validatedData['rooms_id']);
        $days = (new \Carbon\Carbon($validatedData['checkout_date']))
            ->diffInDays(new \Carbon\Carbon($validatedData['checkin_date']));
        $validatedData['total_payment'] = $days * $room->price;


        // Periksa ketersediaan kamar di kategori
        if ($category->number_of_rooms <= 0) {
            return redirect()->back()->withErrors(['rooms_id' => 'Room category is no longer available.']);
        }

        // Kurangi jumlah kamar di kategori
        $category->decrement('number_of_rooms');

        // Ubah status kamar menjadi booked
        $room->update(['status' => '0']);

        // Simpan data reservasi
        Reservation::create($validatedData);

        return redirect()->route('backend.reservation.index')->with('success', 'Data Saved Successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $reservation = Reservation::with(['guest', 'room'])->findOrFail($id);

        return view('backend.v_reservation.show', compact('reservation'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::with(['guest', 'room'])->findOrFail($id);
        $guests = Guest::orderBy('name', 'asc')->get();
        $rooms = Room::orderBy('room_name', 'asc')->get();

        return view('backend.v_reservation.edit', [
            'judul' => 'Edit this Reservation',
            'reservation' => $reservation,
            'guests' => $guests,
            'rooms' => $rooms
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'guests_id' => 'required|exists:guests,id',
            'rooms_id' => 'required|exists:rooms,id',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
            'payment_method' => 'required|boolean',
        ]);

        // Menambahkan kolom updated_by
        $validatedData['updated_by'] = auth()->id();

        // Update data
        Reservation::where('id', $id)->update($validatedData);

        // Redirect ke halaman index
        return redirect()->route('backend.reservation.index')->with('success', 'Data Updated Successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('backend.reservation.index')->with('success', 'Data Saved Successfully');
    }


    // cancel reservation
    public function cancel($id)
    {
        // Cari reservasi berdasarkan ID
        $reservation = Reservation::findOrFail($id);

        // Ambil data kamar terkait
        $room = Room::findOrFail($reservation->rooms_id);
        $room->update(['status' => '1']);

        // Kembalikan jumlah kamar di kategori terkait
        $category = RoomCategory::findOrFail($room->room_categories_id);
        $category->increment('number_of_rooms');

        // Hapus data reservasi
        $reservation->delete();

        // Redirect ke halaman daftar reservasi dengan pesan sukses
        return redirect()->route('backend.reservation.index')->with('success', 'Reservation successfully canceled.');
    }



    // Method untuk Form Laporan Produk 
    public function formReservation()
    {
        return view('backend.v_reservation.form', [
            'judul' => 'Reservation Form Report',
        ]);
    }

    // Method untuk Cetak Laporan Produk 
    public function printReport(Request $request)
    {
        // Validasi input
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.required' => 'Start Date must be filled in.',
            'end_date.required' => 'End Date must be filled in.',
            'end_date.after_or_equal' => 'The End Date must be greater than or equal to the Start Date.',
        ]);

        // Ambil input tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query data reservasi berdasarkan rentang tanggal
        $reservations = Reservation::with(['guest', 'room']) // Pastikan relasi di-load
            ->whereBetween('checkin_date', [$startDate, $endDate])
            ->orderBy('id', 'desc')
            ->get();

        // Kirim data ke view cetak
        return view('backend.v_reservation.print', [
            'judul' => 'Reservation Data Report',
            'startDate' => $startDate,
            'endDate' => $endDate,
            'prints' => $reservations,
        ]);
    }
}
