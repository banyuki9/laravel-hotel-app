<?php

namespace App\Services\Plan;
use App\Models\Plan;

class PlanService
{
  /**
   * Get the room plan data
   *
   * @return object
   */
  public static function getRoomPlans($request)
  {
    $room_id = (int) $request->route('id');
    return Plan::where('room_id', $room_id)->get();
  }

  public static function getPlan($plan_id)
  {
    return Plan::where('id', $plan_id)->firstOrFail();
  }
}