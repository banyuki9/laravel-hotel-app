<?php

namespace App\Services\Image;

use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ImageService
{

  public function saveRoomThumbnail($image, $room_id)
  {
    if (!empty($image)) {
      $this->saveImage($image, $room_id, 0, true);
    }
  }

  public function saveRoomSubImages($images, $room_id)
  {
    if (!empty($images)) {
      foreach ($images as $index => $image) {
        $this->saveImage($image, $room_id, $index, false);
      }
    }
  }

  public function saveImage($image, $room_id, $index, $is_thumbnail)
  {
    Storage::put('public/images', $image);
    $imageModel = new Image();
    $imageModel->link = $image->hashName();
    $imageModel->room_id = $room_id;
    $imageModel->is_thumbnail = $is_thumbnail;
    $imageModel->order = $index;
    $imageModel->save();
  }

  public function deleteImage($delete_image)
  {
    $file_path = 'public/images/' . $delete_image['link'];
    if (Storage::exists($file_path)) {
      Storage::delete($file_path);
    }
    $image = Image::where('id', $delete_image['id'])->firstOrFail();
    $image->delete();
  }
}
