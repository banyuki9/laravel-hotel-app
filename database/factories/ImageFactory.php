<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use App\Models\Room;
use App\Models\Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{

    private static int $imageOrder = 1;
    private static int $roomId = 0;
    protected $model = Image::class;
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
            'order' => self::$imageOrder++,
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Image $image) {
            //
        })->afterCreating(function (Image $image) {
            if (self::$roomId !== $image->room_id) {
                self::$roomId = $image->room_id;
                self::$imageOrder = 1;
            }
        });
    }
}
