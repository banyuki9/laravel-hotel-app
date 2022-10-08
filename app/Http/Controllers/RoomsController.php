<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Room\CreateRequest;
use App\Models\Room;
use Inertia\Inertia;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Services\Room\RoomService;
use App\Services\Plan\PlanService;

class RoomsController extends Controller
{
    public function index()
    {
        return Inertia::render('Room/Rooms', [
            'rooms' => Room::orderBy('created_at', 'desc')->paginate(12),
        ]);
    }

    public function show(Request $request)
    {
        $room = RoomService::getRoomDetail($request->route('id'));
        $plans = PlanService::getRoomPlans($request);
        return Inertia::render('Room/RoomDetail', [
            'room' => $room,
            'plans' => $plans,
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
        $room = RoomService::getRoomDetail($request->route('id'));
        return Inertia::render('Room/RoomEdit', [
            'room' => $room,
        ]); 
    }

    public function store(CreateRequest $request)
    {
        auth()->user()->rooms()->create($request->all());
        return redirect()->route('rooms.index');
    }

    public function update(CreateRequest $request)
    {
        $room = RoomService::getRoomDetail($request->route('id')); 
        $room->update($request->all());
        return redirect()->route('rooms.show', $request->route('id'));
    }

    public function delete(Request $request)
    {
        $room = RoomService::getRoomDetail($request->route('id'));
        $room->delete();
        return redirect()->route('rooms.index');
    }

}
