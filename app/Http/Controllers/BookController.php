<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Book\indexRequest;
use App\Services\Plan\PlanService;
use App\Models\Room;
use App\Models\Book;
use Inertia\Inertia;
use \Carbon\Carbon;
use App\Services\Book\BookService;

class BookController extends Controller
{
    public function index(indexRequest $request)
    {
        // dd($request->adult);
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
            'start' => $request->startDate ? Carbon::parse($request->startDate) : Carbon::today(),
            'end' => $request->endDate ? Carbon::parse($request->endDate) : Carbon::tomorrow(),
            'termDays' => $termDays,
            'holidaysCount' => $holidaysCount,
        ]);
    }

    public function storeBookData(Request $request)
    {
        $book = [
            'planId' => $request->planId,
            'start' => $request->startDate,
            'end' => $request->endDate,
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

    public function storeCustomerData(Request $request)
    {
        $customerData = [
            'name_kanji' => $request->name_kanji,
            'name_kana' => $request->name_kana,
            'number' => $request->number,
            'note' => $request->note,
        ];
        $request->session()->put('customerData', $customerData);
        return redirect()->route('book.payment');
    }

    public function createBookPayment(Request $request)
    {
        $book = $request->session()->get('book');
        $plan = PlanService::getPlan($book['planId']);
        return Inertia::render('Book/BookPayment', [
            'plan' => $plan,
            'room' => $plan->room
        ]); 
    }

    public function complete(Request $request)
    {
        $book = BookService::getBookData($request->route('id'));

        return Inertia::render('Book/BookComplete', [
            'book' => $book,
        ]);  
    }
}
