<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Auth;

class StripePaymentsController extends Controller
{
    public function payment(Request $request)
    {
        // dd($request->stripeData['id']);
        try {
            Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            $customer = Customer::create(array(
                'email' => Auth::user()->email,
                'description' => 'ホテルのご予約',
                'source' => $request->stripeData['id'],
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 2000,
                'currency' => 'jpy',
            ));

            dd($charge);
            return redirect()->route('book.complete');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


}
