<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use App\Services\Book\BookService;
use App\Services\Auth\AuthService;
use Inertia\Inertia;

class StripePaymentsController extends Controller
{
    public function payment(Request $request, BookService $bookService, AuthService $authService)
    {
        
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            
            $customer = Customer::create(array(
                'email' => Auth::user()->email,
                'description' => 'ホテルのご予約',
                'source' => $request->stripeData['id'],
            ));
            
            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $request->session()->get('book')['roomTotalAmount'],
                'currency' => 'jpy',
            ));
            
            $book_data = $bookService->insertBookData($request);
            $authService->updateCustomerUserData($request);
            $this->deleteSessionData($request);

            return redirect()->route('book.complete', $book_data->id);

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function deleteSessionData($request) 
    {
        $request->session()->forget('book');
        $request->session()->forget('customerData');
    }

}