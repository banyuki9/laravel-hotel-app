<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;
use \Carbon\Carbon;

class DashboardfController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        return Inertia::render('Dashboard', [
            'rooms' => Room::with('images')->orderBy('created_at', 'desc')->take(2)->get(),
            'checkin_book' => Book::with(['plan', 'plan.room'])->where('checkin_at', '=', $today)->take(4)->get(),
            'checkout_book' => Book::with(['plan', 'plan.room'])->where('checkout_at', '=', $today)->take(4)->get(),
        ]);

    }
}
