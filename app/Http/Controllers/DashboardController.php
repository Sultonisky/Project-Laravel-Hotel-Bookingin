<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\Claim;
use App\Models\Message;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        return view('backend.dashboard.dashboard', [
            'totalPenerima' => User::where('role', 'penerima')->count(),
            'totalItems' => Item::count(),
            'totalClaims' => Claim::count(),
            'totalMessages' => Message::count(),
            'latestItems' => Item::with(['category', 'donor'])->whereHas('donor', function ($query) {
                $query->where('role', 'donatur');
            })->latest()->take(5)->get(),
        ]);
    }
}
