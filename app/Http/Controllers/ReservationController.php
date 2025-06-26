<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Room;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\RoomCategory;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservation = Reservation::orderBy('updated_at', 'desc')->get();
        return view('backend.v_reservation.index', [
            'judul' => 'Reservation Data',
            'index' => $reservation
        ]);
    }

    public function create()
    {
        $guest = Guest::orderBy('name', 'asc')->get();
        $room = Room::where('status', 1)
            ->whereHas('category', function ($query) {
                $query->where('number_of_rooms', '>', 0);
            })
            ->orderBy('room_name', 'asc')
            ->get();

        return view('backend.v_reservation.create', [
            'judul' => 'Add Reservation Data',
            'guests' => $guest,
            'rooms' => $room,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'guests_id' => 'required|exists:guests,id',
            'rooms_id' => 'required|exists:rooms,id',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
            'payment_method' => 'required',
            'status' => 'required|in:pending,success,canceled',
        ]);

        // $validatedData['status'] = 'pending';
        $validatedData['created_by'] = auth()->id();
        $validatedData['updated_by'] = auth()->id();

        // Tambahkan booking_code unik
        $validatedData['booking_code'] = 'BOOK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(8));

        // Hitung total pembayaran
        $room = Room::findOrFail($validatedData['rooms_id']);
        $category = RoomCategory::findOrFail($room->room_categories_id);

        $days = Carbon::parse($validatedData['checkout_date'])->diffInDays(
            Carbon::parse($validatedData['checkin_date'])
        );
        $room_price_total = $days * $room->price;
        $tax = $room_price_total * 0.01; // 0.1%
        $service = 50000 * $days;
        $validatedData['total_payment'] = $room_price_total + $tax + $service;
        // Periksa ketersediaan kamar di kategori
        if ($category->number_of_rooms <= 0) {
            return redirect()->back()->withErrors(['rooms_id' => 'Room category is no longer available.']);
        }

        // Update stok kamar dan status
        $category->decrement('number_of_rooms');
        $room->update(['status' => 0]);

        Reservation::create($validatedData);

        return redirect()->route('backend.reservation.index')->with('success', 'Data Saved Successfully');
    }

    public function show($id)
    {
        $reservation = Reservation::with(['guest', 'room'])->findOrFail($id);
        return view('backend.v_reservation.show', compact('reservation'));
    }

    public function edit($id)
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

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'guests_id' => 'required|exists:guests,id',
            'rooms_id' => 'required|exists:rooms,id',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
            'payment_method' => 'required',
            'status' => 'required|in:pending,success,canceled',
        ]);

        $validatedData['updated_by'] = auth()->id();

        // Ambil data kamar & hitung ulang total
        $room = Room::findOrFail($validatedData['rooms_id']);
        $days = Carbon::parse($validatedData['checkout_date'])->diffInDays(
            Carbon::parse($validatedData['checkin_date'])
        );
        $room_price_total = $days * $room->price;
        $tax = $room_price_total * 0.01;
        $service = 50000;
        $validatedData['total_payment'] = $room_price_total + $tax + $service;

        Reservation::where('id', $id)->update($validatedData);

        return redirect()->route('backend.reservation.index')->with('success', 'Data Updated Successfully');
    }


    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        // Soft delete: data tidak dihapus permanen, hanya disembunyikan
        $reservation->delete();
        return redirect()->route('backend.reservation.index')->with('success', 'Data Deleted Successfully');
    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);
        // Set kamar jadi ready
        $room = Room::findOrFail($reservation->rooms_id);
        $room->update(['status' => 1]);
        // Tambah stok kamar kategori
        $category = RoomCategory::findOrFail($room->room_categories_id);
        $category->increment('number_of_rooms');
        // Soft delete: data tidak dihapus permanen, hanya disembunyikan
        $reservation->delete();
        return redirect()->route('backend.reservation.index')->with('success', 'Reservation successfully canceled.');
    }

    public function formReservation()
    {
        return view('backend.v_reservation.form', [
            'judul' => 'Reservation Form Report',
        ]);
    }

    public function printReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ], [
            'start_date.required' => 'Start Date must be filled in.',
            'end_date.required' => 'End Date must be filled in.',
            'end_date.after_or_equal' => 'The End Date must be greater than or equal to the Start Date.',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $reservations = Reservation::with(['guest', 'room'])
            ->whereBetween('checkin_date', [$startDate, $endDate])
            ->orderBy('id', 'desc')
            ->get();

        return view('backend.v_reservation.print', [
            'judul' => 'Reservation Data Report',
            'startDate' => $startDate,
            'endDate' => $endDate,
            'prints' => $reservations,
        ]);
    }

    public function rescheduleForm($id)
    {
        $reservasi = Reservation::findOrFail($id);
        return view('backend.v_reservation.reschedule', compact('reservasi'));
    }

    public function reschedule(Request $request, $id)
    {
        $validatedData = $request->validate([
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        $reservasi = Reservation::findOrFail($id);
        $reservasi->checkin_date = $validatedData['checkin_date'];
        $reservasi->checkout_date = $validatedData['checkout_date'];
        $reservasi->total_payment = $reservasi->calculateTotalPayment(
            $validatedData['checkin_date'],
            $validatedData['checkout_date']
        );

        // Gunakan helper di model
        $reservasi->total_payment = $reservasi->calculateTotalPayment();
        $reservasi->updated_by = auth()->id();

        $reservasi->save();

        return redirect()->route('backend.reservation.index')->with('success', 'Reschedule successfully.');
    }

    /**
     * Tampilkan data reservasi yang sudah dihapus (soft delete)
     */
    public function trashed()
    {
        $trashed = Reservation::onlyTrashed()->with(['guest', 'room'])->get();
        return view('backend.v_reservation.trashed', [
            'judul' => 'Trashed Reservations',
            'trashed' => $trashed,
        ]);
    }

    /**
     * Restore data reservasi yang sudah dihapus (soft delete)
     */
    public function restore($id)
    {
        $reservation = Reservation::onlyTrashed()->findOrFail($id);
        $reservation->restore();
        return redirect()->route('backend.reservation.trashed')->with('success', 'Data berhasil dipulihkan!');
    }
}
