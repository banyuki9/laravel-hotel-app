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
use App\Mail\BookConfirmation;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Support\Facades\DB;

class StripePaymentsController extends Controller
{
    public function payment(Request $request, BookService $bookService, AuthService $authService, Mailer $mailer)
    {
        
        try {
            DB::beginTransaction();
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
            
            $bookData = $bookService->insertBookData($request);
            $authService->updateCustomerUserData($request);
            $mailer->to(Auth::user()->email)->send(new BookConfirmation($bookData, Auth::user()));
            $bookService->deleteSessionData($request);
            DB::commit();
            return redirect()->route('book.complete', $bookData->id);

        } catch (Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }


}
