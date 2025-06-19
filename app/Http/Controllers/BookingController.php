<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Midtrans\Snap;
use App\Models\Room;
use Midtrans\Config;
use App\Models\Guest;
use App\Models\Reservation;
use Illuminate\Support\Str;
use App\Models\RoomCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY'); // Ganti dengan serverKey sandbox kamu
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    private function generateSnapToken($booking_code, $total_payment, $guest, $reservation, $room, $days)
    {
        try {
            $params = [
                'transaction_details' => [
                    'order_id' => $booking_code,
                    'gross_amount' => intval($total_payment),
                ],
                'customer_details' => [
                    'first_name' => $guest->name,
                    'email' => $guest->email,
                    'phone' => $guest->no_hp,
                ],
                'callbacks' => [
                    'finish' => route('frontend.booking.success', ['code' => $booking_code])
                ],
                'item_details' => [
                    [
                        'id' => 'ROOM-' . $room->id,
                        'price' => intval($room->price),
                        'quantity' => $days,
                        'name' => $room->category->category_name ?? 'Hotel Room Bookingin',
                    ],
                    [
                        'id' => 'SERVICE',
                        'price' => 50000,
                        'quantity' => $days,
                        'name' => 'Service Charge',
                    ],
                    [
                        'id' => 'TAX',
                        'price' => intval(($room->price * $days) * 0.01),
                        'quantity' => 1,
                        'name' => 'Tax 1%',
                    ]
                ]
            ];

            return Snap::getSnapToken($params);
        } catch (Exception $e) {
            logger()->error('Midtrans Snap Error: ' . $e->getMessage());
            return response()->json(['error' => 'Gagal membuat token pembayaran.'], 500);
        }
    }


    public function showForm($room_id, Request $request)
    {
        $room = Room::with('photos')->findOrFail($room_id);
        return view('frontend.v_room_details.reservation.reservation', [
            'room' => $room,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
        ]);
    }

    public function showQuickBookingForm($id, Request $request)
    {
        $room = Room::with('category', 'photos')->findOrFail($id);

        $checkin = $request->checkin_date;
        $checkout = $request->checkout_date;

        return view('frontend.v_room_details.reservation.quick_form_reservation', compact('room', 'checkin', 'checkout'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'no_hp' => 'required|min:10|max:13',
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
            'payment_method' => 'required',
        ]);

        $guest = Guest::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => Auth::user()->foto ?? 'backend/images/img-user/img-default.jpg'
        ]);

        $room = Room::findOrFail($request->room_id);
        $category = RoomCategory::findOrFail($room->room_categories_id);

        $days = Carbon::parse($request->checkout_date)->diffInDays(Carbon::parse($request->checkin_date));
        $total_price = $days * $room->price;
        $tax = $total_price * 0.01;
        $service = 50000 * $days;

        $total_payment = $total_price + $tax + $service;

        $booking_code = 'BOOK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(8));

        $reservation = Reservation::create([
            'booking_code' => $booking_code,
            'guests_id' => $guest->id,
            'rooms_id' => $room->id,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'payment_method' => $request->payment_method,
            'total_payment' => $total_payment,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        // ⬇ generate token
        $snapToken = $this->generateSnapToken($booking_code, $total_payment, $guest, $reservation, $room, $days, $tax);

        $room->update(['status' => 0]);
        $category->decrement('number_of_rooms');

        // arahkan ke halaman payment dengan token
        return response()->json([
            'snapToken' => $snapToken,
            'booking_code' => $reservation->booking_code
        ]);

        // return redirect()->route('frontend.booking.success', ['code' => $booking_code])->with('success', 'Your Booking Successfully!');
    }

    public function storeQuickBooking(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'no_hp' => 'required',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'payment_method' => 'required',
            'rooms_id' => 'required|exists:rooms,id',
        ]);

        // 1. Simpan data guest
        $guest = Guest::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'foto' => Auth::user()->foto ?? 'backend/images/img-user/img-default.jpg',
        ]);

        $room = Room::findOrFail($request->rooms_id);
        $category = RoomCategory::findOrFail($room->room_categories_id);

        $days = max(Carbon::parse($request->checkout_date)->diffInDays(Carbon::parse($request->checkin_date)), 1);

        $total_price = $days * $room->price;
        $tax = $total_price * 0.01;
        $service = 50000 * $days;

        $total_payment = $total_price + $tax + $service;

        $booking_code = 'BOOK-' . now()->format('Ymd') . '-' . strtoupper(Str::random(8));

        // 2. Simpan data reservasi
        $reservation = Reservation::create([
            'booking_code' => $booking_code,
            'guests_id' => $guest->id,
            'rooms_id' => $room->id,
            'checkin_date' => $request->checkin_date,
            'checkout_date' => $request->checkout_date,
            'payment_method' => $request->payment_method,
            'total_payment' => $total_payment,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        $room->update(['status' => 0]);
        $category->decrement('number_of_rooms');

        try {
            $snapToken = $this->generateSnapToken($booking_code, $total_payment, $guest, $reservation, $room, $days, $tax);
        } catch (\Exception $e) {
            Log::error('Gagal generate Snap: ' . $e->getMessage());
            return response()->json([
                'error' => 'Gagal memproses pembayaran. Silakan coba lagi.'
            ], 500);
        }
        return response()->json([
            'snapToken' => $snapToken,
            'booking_code' => $reservation->booking_code
        ]);



        // return redirect()->route('frontend.booking.success', ['code' => $booking_code])->with('success', 'Your Booking Successfully!');
    }


    public function success($code)
    {
        $booking = Reservation::with(['guest', 'room.category'])->where('booking_code', $code)->firstOrFail();

        return view('frontend.v_room_details.reservation.reservation-success', [
            'booking' => $booking
        ]);
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

        $reservation->delete();

        return redirect()->route('history')->with('success', 'Booking successfully canceled.');
    }

    public function reschedule(Request $request, $id)
    {
        $validatedData = $request->validate([
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        $reservation = Reservation::findOrFail($id);

        // Cek durasi tetap
        $oldDuration = \Carbon\Carbon::parse($reservation->checkout_date)->diffInDays($reservation->checkin_date);
        $newDuration = \Carbon\Carbon::parse($validatedData['checkout_date'])->diffInDays($validatedData['checkin_date']);


        if ($newDuration !== $oldDuration) {
            return response()->json(['errors' => ['checkout_date' => ['Durasi inap harus sama dengan sebelumnya.']]], 422);
        }

        // Cek ketersediaan kamar
        $conflict = Reservation::where('room_id', $reservation->room_id)
            ->where('id', '!=', $reservation->id)
            ->where(function ($query) use ($validatedData) {
                $query->whereBetween('checkin_date', [$validatedData['checkin_date'], $validatedData['checkout_date']])
                    ->orWhereBetween('checkout_date', [$validatedData['checkin_date'], $validatedData['checkout_date']])
                    ->orWhere(function ($q) use ($validatedData) {
                        $q->where('checkin_date', '<=', $validatedData['checkin_date'])
                            ->where('checkout_date', '>=', $validatedData['checkout_date']);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['checkin_date' => 'Kamar tidak tersedia di tanggal yang dipilih.']);
        }

        // Simpan perubahan tanggal
        $reservation->checkin_date = $validatedData['checkin_date'];
        $reservation->checkout_date = $validatedData['checkout_date'];
        $reservation->updated_by = auth()->id();
        $reservation->save();

        return response()->json(['message' => 'Reschedule Successfully!']);
    }
}
