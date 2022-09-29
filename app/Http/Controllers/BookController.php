<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Plan\PlanService;
use App\Models\Room;
use App\Models\Book;
use Inertia\Inertia;
use \Carbon\Carbon;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Room::query();

        $termDays = Book::getTermDays($request->startDate, $request->endDate);
        $holidaysCount = Book::getHolidaysCount($termDays);
        $rooms = $query->latest()->with('plans')->paginate(10);
        $guests = Book::getGuestNumbers($request->adult, $request->child);

        if ($request->adult) {
            $query->where('max_capacity', '>=', ($request->adult + $request->child));
        }

        return Inertia::render('Book/Books', [
            'rooms' => $rooms,
            'guests' => $guests,
            'start' => $request->startDate ? Carbon::createFromTimestamp($request->startDate / 1000) : Carbon::today(),
            'end' => $request->endDate ? Carbon::createFromTimestamp($request->endDate / 1000) : Carbon::tomorrow(),
            'termDays' => $termDays,
            'holidaysCount' => $holidaysCount,
        ]);
    }

    public function storeBookData(Request $request)
    {
        $book = [
            'planId' => $request->planId,
            'start' => $request->start,
            'end' => $request->end,
            'adult' => $request->adult,
            'child' => $request->child,
            'dateOfNights' => $request->dateOfNights,
            'roomTotalAmount' => $request->roomTotalAmount,
        ];

        $request->session()->put('book', $book);
        return redirect()->route('book.create');
    }
    
    public function create(Request $request) 
    {
        if (empty($request->session()->get('book'))) {
            return redirect()->route('book.index');
        }
        $book = $request->session()->get('book');
        $plan = PlanService::getPlan($book['planId']);

        return Inertia::render('Book/BookCreate', [
            'plan' => $plan,
            'room' => $plan->room
        ]);
    }
}
