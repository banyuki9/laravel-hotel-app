<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Book\indexRequest;
use App\Http\Requests\Book\CreateCustomerDataRequest;
use App\Services\Plan\PlanService;
use App\Models\Room;
use App\Models\Book;
use Inertia\Inertia;
use \Carbon\Carbon;
use App\Services\Book\BookService;

class BookController extends Controller
{
    public function index(indexRequest $request, BookService $bookService)
    {
        $bookService->saveBookUrl($request);
        $query = Room::query();

        if ($request->adult) {
            $query->where('max_capacity', '>=', ($request->adult + $request->child));
        }
        $termDays = Book::getTermDays($request->startDate, $request->endDate);
        $holidaysCount = Book::getHolidaysCount($termDays);
        $rooms = $query->latest()->with('plans')->paginate(10);
        $guests = Book::getGuestNumbers($request->adult, $request->child);


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

        $book = $request->session()->get('book');
        $plan = PlanService::getPlan($book['planId']);

        return Inertia::render('Book/BookCreate', [
            'plan' => $plan,
            'room' => $plan->room
        ]);
    }

    public function storeCustomerData(CreateCustomerDataRequest $request)
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

    public function createBookPayment(Request $request, BookService $bookService)
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

    public function userBookIndex(Request $request) 
    {
        $books = BookService::getUserBooks($request->route('user_id'));

        return Inertia::render('Book/UserBookIndex', [
            'books' => $books,
        ]);
    }

    public function userBookShow(Request $request)
    {
        $book = BookService::getUserBookDetail($request->book_code);

        return Inertia::render('Book/UserBookDetail', [
            'book' => $book,
        ]);  
    }

    public function checkInBook(Request $request)
    {
        $book = Book::where('id', '=', $request->book_id)->firstOrFail();
        $book->checkin_status = true;
        $book->save();
        return redirect()->route('book.user-book-show',['user_id' => $book->user_id, 'book_code' => $book->book_code]);
    }

    function checkInBookIndex(Request $request, BookService $bookService)
    {
        $books = $bookService->getTodayCheckInBook($request);

        return Inertia::render('Book/CheckInBookIndex', [
            'books' => $books,
            'today' => Carbon::today()->toDateString(),
            'checkinStatus' => $request->checkinStatus ? $request->checkinStatus : 0,
            'bookCode' => $request->bookCode ? $request->bookCode : "",
        ]);  
    }

    function checkOutBookIndex(Request $request, BookService $bookService)
    {
        $books = $bookService->getTodayCheckOutBook($request);

        return Inertia::render('Book/CheckOutBookIndex', [
            'books' => $books,
            'today' => Carbon::today()->toDateString(),
            'checkoutStatus' => $request->checkoutStatus ? $request->checkoutStatus : 0,
            'bookCode' => $request->bookCode ? $request->bookCode : "",
        ]);  
    }

}
