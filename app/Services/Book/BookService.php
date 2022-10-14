<?php

namespace App\Services\Book;

use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookService
{
  public function insertBookData(Request $request)
  {
    $book = $request->session()->get('book');
    $customer_data = $request->session()->get('customerData');
    $book_code = $this->createBookCode();

    $book_data = Book::create([
      'user_id' => Auth::id(),
      'plan_id' => $book['planId'],
      'note' => $customer_data['note'],
      'adult_number' => $book['adult'],
      'child_number' => $book['child'],
      'total_amount' => $book['roomTotalAmount'],
      'stripe_id' => $request->stripeData['id'],
      'has_credit_card' => $request->hasCreditCard,
      'book_code' => $book_code,
      'checkin_at' => Carbon::parse($book['start']),
      'checkout_at' => Carbon::parse($book['end']),
      'booked_at' => date("Y/m/d H:i:s")
    ]);

    return $book_data;
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

  public static function getBookData($book_id)
  {
    return Book::where('id', $book_id)->where('user_id', Auth::id())->firstOrFail();
  }

  public function saveBookUrl($request)
  {
    $request->session()->put('bookUrl', $request->fullUrl());
  }

  public static function getUserBooks($user_id)
  {
    $today = Carbon::today();
    
    $stayed_book = Book::with(['plan', 'plan.room'])->where('user_id', '=', $user_id)->whereDate('checkin_at', '<=', $today)->whereDate('checkin_at', '!=', $today)->orderBy('checkin_at', 'desc')->get();
    $not_stayed_book = Book::with(['plan', 'plan.room'])->where('user_id', '=', $user_id)->whereDate('checkin_at', '>=', $today)->orderBy('checkin_at', 'asc')->get();

    $books = [
      'stayed_book' => $stayed_book,
      'not_stayed_book' => $not_stayed_book,
    ];
    return $books;
  }

  public static function getUserBookDetail($book_code)
  {
    $book = Book::with(['plan', 'user', 'plan.room'])->where('book_code', '=', $book_code)->firstOrFail();

    return $book;
  }

  public function deleteSessionData(Request $request)
  {
    $request->session()->forget('book');
    $request->session()->forget('bookUrl');
    $request->session()->forget('customerData');
  }

  public function getTodayCheckInBook(Request $request)
  {
    $today = Carbon::today();
    $query = Book::query();
    if ($request->checkinStatus) {
      $query->where('checkin_status', '=', true);
    } else {
      $query->where('checkin_status', '=', false);
    }
    
    if ($request->bookCode) {
      $query->where('book_code', '=', $request->bookCode);
    }

    $books = $query->with(['plan', 'plan.room'])->where('checkin_at', '=', $today)->paginate(10);
    return $books;
  }
}
