<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $room_id = (int) $request->route('id');
        $room = Room::where('id', $room_id)->first();
        if (is_null($room_id)) {
            throw new NotFoundHttpException('存在しない客室です。');
        }
        return Inertia::render('Room/RoomDetail', [
            'room' => $room,
        ]);
    }
}
