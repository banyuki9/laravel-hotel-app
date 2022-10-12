<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
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
            'plan_id' => 1,
            'note' => '備考が入ります。備考が入ります。',
            'adult_number' => 2,
            'child_number' => 0,
            'total_amount' => 14000,
            'stripe_id' => 'xxxxxxxxxxxxxxxx',
            'checkin_status' => false,
            'has_credit_card' => true,
            'book_code' => 'xxxxxxxxxxxxxxxx',
            'checkin_at' => Carbon::today(),
            'checkout_at' => Carbon::tomorrow(),
            'booked_at' => Carbon::yesterday(),
        ];
    }
}
