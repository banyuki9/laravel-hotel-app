<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\Image;
use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::factory()->count(20)->create()
            ->each(function ($room) {
                Image::factory()->count(1)->create(['room_id' => $room->id, 'is_thumbnail' => true]);
                Image::factory()->count(4)->create(['room_id' => $room->id]);
            })
            ->each(function ($room) {
                Plan::factory()->count(2)->create(['room_id' => $room->id]);
            });
    }
}
