<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Room;
use App\Models\User;
use App\Models\Guest;
use App\Models\Contact;
use App\Models\Reservation;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function berandaBackend()
    {
        $data = [
            'judul' => 'Dashboard',
            'totalReservations' => Reservation::count(),
            'totalSuccessReservations' => Reservation::where('status', 'success')->count(),
            'totalPendingReservations' => Reservation::where('status', 'pending')->count(),
            'totalGuests' => Guest::count(),
            'totalMoney' => Reservation::where('status', 'success')->sum('total_payment'),
        ];

        if (auth()->user()->role == 1) {
            $data['totalUsers'] = User::count();
            $data['totalReadyRooms'] = Room::where('status', 1)->count();
            $data['totalBookedRooms'] = Room::where('status', 0)->count();
            $data['totalRooms'] = Room::count();
            $data['totalContacts'] = Contact::count();
        }
        return view('backend.v_beranda.index', $data);
    }
    public function index()
    {
        return view('frontend.v_beranda.index', []);
    }
    public function profileUser()
    {
        return view('frontend.v_beranda.profile.profile', []);
    }


    public function selectRoomByDate(Request $request)
    {
        $request->validate([
            'checkin_date' => 'required|date|after_or_equal:today',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        $startDate = $request->checkin_date;
        $endDate = $request->checkout_date;

        $rooms = Room::with('category') // biar tidak N+1 saat akses $row->category
            ->where('status', 1)
            ->get();

        return view('frontend.v_room_details.selectRoomByDate', [
            'rooms' => $rooms,
            'checkin_date' => $startDate,
            'checkout_date' => $endDate,
        ]);
    }



    public function about()
    {
        return view('frontend.v_beranda.about', []);
    }
    public function room()
    {
        $room = Room::orderBy('updated_at', 'desc')->get();
        return view('frontend.v_beranda.room', [
            'room' => $room
        ]);
    }

    public function contact()
    {
        return view('frontend.v_beranda.contact', []);
    }

    public function historyBooking()
    {
        $reservations = Reservation::with(['room.category'])->where('created_by', auth()->id())->orderBy('id', 'desc')->latest()->get();
        return view('frontend.v_beranda.history', compact('reservations'));
    }

    public function contactStore(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'messages' => 'required|max:255|string',
        ]);

        $validatedData['users_id'] = auth()->id();

        Contact::create($validatedData);
        return redirect()->route('contact')->with('success', 'Your Message Sent Successfully');
    }
}
