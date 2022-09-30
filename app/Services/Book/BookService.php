<?php

namespace App\Services\Book;

use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookService
{
  public function insertBookData(Request $request, $stripe_id, $has_credit_card)
  {
    $book = $request->session()->get('book');
    $customer_data = $request->session()->get('customerData');
    $book_code = $this->createBookCode();

    Book::create([
      'user_id' => Auth::id(),
      'plan_id' => $book['planId'],
      'note' => $customer_data['note'],
      'adult_number' => $book['adult'],
      'child_number' => $book['child'],
      'total_amount' => $book['roomTotalAmount'],
      'stripe_id' => $stripe_id,
      'checkin_status' => false,
      'has_credit_card' => $has_credit_card,
      'book_code' => $book_code,
      'checkin_at' => Carbon::parse($book['start']),
      'checkout_at' => Carbon::parse($book['end']),
      'booked_at' => date("Y/m/d H:i:s")
    ]);

    return $book_code;
  }

  public function createBookCode()
  {
    $is_book_data = false;
    $book_code = "";
    while ($is_book_data === false) {
      $book_code = substr(str_shuffle('1234567890abcdefghijklmnopqrstuvwxyz'), 0, 16);
      if (!Book::where('book_code', '=', $book_code)->exists()) {
        $is_book_data = true;
      }
    }
    return $book_code;
  }
}
