<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Inertia\Inertia;
use App\Services\Room\RoomService;
use App\Services\Plan\PlanService;

class PlanController extends Controller
{
    public function create(Request $request)
    {
        $room = RoomService::getRoomDetail($request);
        return Inertia::render('Plan/PlanCreate', [
            'plan' => new Plan(),
            'room' => $room
        ]);
    }

    public function store(Request $request)
    {
        $plan = Plan::create([
            'room_id' => $request->route('id'),
            'title' => $request->title,
            'order' => Plan::max('order') + 1,
            'day_fee' => $request->day_fee,
            'holiday_fee' => $request->holiday_fee,
            'plan_detail' => $request->plan_detail,
        ]);
        return redirect()->route('rooms.show', $request->route('id'));
    }
}
