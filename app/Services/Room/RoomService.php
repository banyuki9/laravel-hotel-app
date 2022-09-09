<?php

namespace App\Services\Room;

use App\Models\Room;


class RoomService
{

  /**
   * Get the user role 
   *
   * @return boolean
   */
  public static function getRoomDetail($request)
  {
    $room_id = (int) $request->route('id');
    return Room::where('id', $room_id)->firstOrFail();
  }
}
