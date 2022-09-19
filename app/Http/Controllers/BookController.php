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
    public function index()
    {
        return Inertia::render('Book/Books', [
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(10),
            'plans' => Plan::orderBy('room_id')->get()
        ]);
    }
}
