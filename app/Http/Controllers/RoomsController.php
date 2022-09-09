<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Room\RoomService;
use Illuminate\Support\Facades\Auth;

class RoomsController extends Controller
{
    public function index()
    {
        return Inertia::render('Room/Rooms', [
            'rooms' => Room::all(),
        ]);
    }

    public function show(Request $request)
    {
        $room = RoomService::getRoomDetail($request);
        return Inertia::render('Room/RoomDetail', [
            'room' => $room,
        ]);
    }

    public function create()
    {
        return Inertia::render('Room/RoomEdit', [
            'room' => '',
        ]);
    }

    public function edit(Request $request)
    {
        $room = RoomService::getRoomDetail($request);
        return Inertia::render('Room/RoomEdit', [
            'room' => $room,
        ]); 
    }

    public function store(Request $request)
    {
        $room = new Room();
        $roomContents = $request->all();
        $room->fill([
            'user_id' => Auth::id(),
            'title' => $roomContents['title'],
            'description' => $roomContents['description'],
            'room_size' => $roomContents['room_size'],
            'min_capacity' => $roomContents['min_capacity'],
            'max_capacity' => $roomContents['max_capacity'],
            'bed_type' => $roomContents['bed_type'],
            'facilities' => $roomContents['facilities'],
        ])->save();
        return redirect()->route('rooms.index');
    }

}
