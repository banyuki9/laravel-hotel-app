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
        return Inertia::render('Room/RoomCreate', [
            'room' => $room,
        ]); 
    }

    public function store(Request $request)
    {
        $room = auth()->user()->rooms()->create($request->all());
        return redirect()->route('rooms.index');
    }



}
