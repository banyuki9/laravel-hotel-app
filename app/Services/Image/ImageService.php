<?php

namespace App\Services\Image;

use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageService
{

  public function saveRoomThumbnail($image, $room_id)
  {
    Storage::put('public/images', $image);
    $imageModel = new Image();
    $imageModel->link = $image->hashName();
    $imageModel->room_id = $room_id;
    $imageModel->is_thumbnail = true;
    $imageModel->order = 0;
    $imageModel->save();
  }


}
