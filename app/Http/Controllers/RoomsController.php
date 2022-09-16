<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Room\RoomService;

class RoomsController extends Controller
{
    public function index()
    {
        return Inertia::render('Room/Rooms', [
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(9),
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
        return Inertia::render('Room/RoomCreate', [
            'room' => new Room(),
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
        auth()->user()->rooms()->create($request->all());
        return redirect()->route('rooms.index');
    }

    public function update(Request $request)
    {
        $room = RoomService::getRoomDetail($request); 
        $room->title = $request->title;
        $room->description = $request->description;
        $room->room_size = $request->room_size;
        $room->min_capacity = $request->min_capacity;
        $room->max_capacity = $request->max_capacity;
        $room->bed_type = $request->bed_type;
        $room->facilities = $request->facilities;
        $room->save();

        return redirect()->route('rooms.show', $request->route('id'));
    }

    public function delete(Request $request)
    {
        $room = RoomService::getRoomDetail($request);
        $room->delete();
        return redirect()->route('rooms.index');
    }

}
