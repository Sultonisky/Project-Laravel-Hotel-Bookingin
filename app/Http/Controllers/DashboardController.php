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
        $user = auth()->user();

        $totalUsersOrPenerima = $user->role === 'admin'
            ? User::count()
            : User::where('role', 'penerima')->count();

        return view('backend.dashboard.dashboard', [
            'totalUsersOrPenerima' => $totalUsersOrPenerima,
            'labelUsersOrPenerima' => $user->role === 'admin' ? 'Total Users' : 'Total Penerima',
            'totalItems' => Item::count(),
            'totalClaims' => Claim::count(),
            'totalMessages' => Message::count(),
            'latestItems' => Item::with(['category', 'donor'])->whereHas('donor', function ($query) {
                $query->where('role', 'donatur');
            })->latest()->take(5)->get(),
        ]);
    }
}
