<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use Inertia\Inertia;
use App\Services\Room\RoomService;
use App\Services\Plan\PlanService;
use App\Http\Requests\Plan\CreateRequest;

class PlanController extends Controller
{
    public function create(Request $request)
    {
        $room = RoomService::getRoomDetail($request->route('id'));
        return Inertia::render('Plan/PlanCreate', [
            'plan' => new Plan(),
            'room' => $room
        ]);
    }

    public function store(CreateRequest $request)
    {
        $plan = new Plan();
        $plan->fill($request->all());
        $plan->order = Plan::max('order') + 1;
        $plan->save();
        return redirect()->route('rooms.show', $request->route('id'));
    }

    public function edit(Request $request)
    {
        $plan = PlanService::getPlan($request->route('plan_id'));
        $room = RoomService::getRoomDetail($request->route('id'));
        return Inertia::render('Plan/PlanEdit', [
            'room' => $room,
            'plan' => $plan,
        ]); 
    }

    public function update(CreateRequest $request)
    {
        $plan = PlanService::getPlan($request->plan_id);
        $plan->update($request->all());
        return redirect()->route('rooms.show', $request->route('id')); 
    }
    
    public function delete(Request $request)
    {
        $plan = PlanService::getPlan($request->plan_id);
        $plan->delete(); 
        return redirect()->route('rooms.show', $request->room_id); 
    }
}
