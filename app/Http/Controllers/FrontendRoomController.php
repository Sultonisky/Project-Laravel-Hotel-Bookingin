<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class FrontendRoomController extends Controller
{

    public function room_detail($id)
    {
        $room = Room::with('photos', 'features')->findOrFail($id);
        return view('frontend.v_room_details.detail_room', compact('room'));
    }

    public function reservation()
    {
        return view('frontend.v_room_details.reservation.reservation');
    }
}
