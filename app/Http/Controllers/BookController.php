<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Room\RoomService;
use App\Services\Plan\PlanService;
use App\Models\Room;
use App\Models\Plan;
use Inertia\Inertia;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        if ($request->adult) {
            $query->where('max_capacity', '>=', ($request->adult + $request->child));
        }
        $rooms = $query->latest()->with('plans')->paginate(10);

        return Inertia::render('Book/Books', [
            'rooms' => $rooms,
        ]);
    }
}
