<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use App\Models\Plan;
use App\Models\User;
use App\Services\Book\BookService;

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
        $bookService = new BookService();
        return [
            'user_id' => 1,
            'plan_id' => Plan::factory(),
            'note' => '備考が入ります。備考が入ります。',
            'adult_number' => 2,
            'child_number' => 0,
            'total_amount' => 14000,
            'stripe_id' => 'xxxxxxxxxxxxxxxx',
            'has_credit_card' => true,
            'book_code' => $bookService->createBookCode(),
            'checkin_at' => Carbon::yesterday(),
            'checkout_at' => Carbon::today(),
            'booked_at' => Carbon::yesterday(),
        ];
    }
}
