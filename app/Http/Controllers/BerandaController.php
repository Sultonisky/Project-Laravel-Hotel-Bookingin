<?php

namespace App\Http\Controllers;

use PDO;
use App\Models\Room;
use App\Models\Contact;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function berandaBackend()
    {
        return view('backend.v_beranda.index', [
            'judul' => 'Dashboard Hotel Bookingin',
        ]);
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
        ], [
            'checkin_date.required' => 'Checkin Date must be filled in.',
            'checkout_date.required' => 'Checkout Date must be filled in.',
            'checkout_date.after_or_equal' => 'The Checkout Date must be greater than or equal to the Checkin Date.',

        ]);

        $startDate = $request->checkin_date;
        $endDate = $request->checkout_date;

        // Ambil kamar yang ready
        $rooms = Room::with('category')
            ->where('status', '1') // hanya kamar yang ready
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('frontend.v_beranda.select_room', [
            'room' => $rooms,
            'checkin' => $startDate,
            'checkout' => $endDate,
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
