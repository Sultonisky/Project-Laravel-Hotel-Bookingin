<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
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
        $guest = Guest::orderBy('name', 'asc')->get();
        $room = Room::orderBy('room_name', 'asc')->get();
        return view('backend.v_reservation.create', [
            'judul' => 'Add Reservation Data',
            'guests' => $guest,
            'rooms' => $room
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
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'payment' => 'required|boolean',
        ]);

        Reservation::create($validatedData);

        return redirect()->route('backend.reservation.index')->with('success', 'Data berhasil tersimpan');
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
        $rules = [
            'guests_id' => 'required|exists:guests,id',
            'rooms_id' => 'required|exists:rooms,id',
            'tanggal_checkin' => 'required|date|after_or_equal:today',
            'tanggal_checkout' => 'required|date|after:tanggal_checkin',
            'payment' => 'required|boolean',
        ];

        $validatedData = $request->validate($rules);

        // Jika total_payment dihitung otomatis
        if ($request->filled('rooms_id')) {
            $room = Room::findOrFail($request->rooms_id);
            $days = (new \Carbon\Carbon($request->tanggal_checkout))
                ->diffInDays(new \Carbon\Carbon($request->tanggal_checkin));
            $validatedData['total_payment'] = $days * $room->price;
        }

        Reservation::where('id', $id)->update($validatedData);

        return redirect()->route('backend.reservation.index')->with('success', 'Data berhasil diperbaharui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('backend.reservation.index')->with('success', 'Data berhasil dihapus');
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
            ->whereBetween('tanggal_checkin', [$startDate, $endDate])
            ->orderBy('id', 'desc')
            ->get();

        // Jika tidak ada data, tampilkan pesan error
        if ($reservations->isEmpty()) {
            return redirect()->back()->withErrors([
                'no_data' => 'No reservation data found for the selected dates.'
            ]);
        }

        // Kirim data ke view cetak
        return view('backend.v_reservation.print', [
            'judul' => 'Reservation Data Report',
            'startDate' => $startDate,
            'endDate' => $endDate,
            'prints' => $reservations,
        ]);
    }
}
