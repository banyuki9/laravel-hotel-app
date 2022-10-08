<?php

namespace App\Services\Room;

use App\Models\Room;


class RoomService
{

  /**
   * Get the room detail  
   *
   * @return object
   */
  public static function getRoomDetail($room_id)
  {
    return Room::where('id', $room_id)->firstOrFail();
  }
}
