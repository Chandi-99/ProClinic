<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
//require_once('stripe-php-master/init.php');
class stripeController extends Controller
{
    public function index(){
        return view('donation');

    }
    public function chargeCustomer(Request $request)
    {
        // Set the Stripe API key
        Stripe::setApiKey(config(key:'stripe.sk'));
    
        // Get the necessary parameters from the request
        $amount = $request->input('amount');
        $currency = 'lkr';
        $token = $request->input('token');
    
        // Create a charge
        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => $currency,
            'source' => $token,
        ]);
    
        // Process the charge response
        // ...
    }
}
