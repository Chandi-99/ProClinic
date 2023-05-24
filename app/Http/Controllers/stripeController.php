<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
//require_once('stripe-php-master/init.php');
class stripeController extends Controller
{
    public function index(){

    }
    public function chargeCustomer(Request $request)
    {
        // Set the Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));
    
        // Get the necessary parameters from the request
        $amount = $request->input('amount');
        $currency = $request->input('currency');
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
