<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->realText(20),
            'description' => $this->faker->realText(100),
            'room_size' => $this->faker->randomNumber(2) . ' ㎡',
            'min_capacity' => 1,
            'max_capacity' => $this->faker->randomNumber(1),
            'bed_type' => $this->faker->realText(20),
            'facilities' => $this->faker->realText(80),
        ];
    }
}
