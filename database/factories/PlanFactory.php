<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Room;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    private static int $sequence = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'room_id' => Room::factory(),
            'title' => $this->faker->realText(20),
            'order' => function () { return self::$sequence++; },
            'day_fee' => $this->faker->randomNumber(5),
            'holiday_fee' => $this->faker->randomNumber(5),
            'plan_detail' => $this->faker->realText(100),
        ];
    }
}
