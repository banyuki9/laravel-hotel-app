<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        if (!Storage::exists('public/images')) {
            Storage::makeDirectory('public/images');
        }

        return [
            'room_id' => Room::factory(),
            'link' => $this->faker->image(storage_path('app/public/images'), 640, 480, null, false),
            'is_thumbnail' => false,
            'order' => 1,
        ];
    }
}
