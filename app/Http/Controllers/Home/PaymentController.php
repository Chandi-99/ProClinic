<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use Stripe;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Nette\Utils\Floats;
use PhpParser\Node\Expr\Cast\Double;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        Session::flash('alert_01', '');
        $name = $request->session()->get('name');
        $email = $request->session()->get('email');
        $amount = $request->session()->get('amount');

        return view('patient.paymentpage',['amount' => $amount, 'name' => $name, 'email' => $email]);
    }
    public function pay(Request $request)
    {
        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // $amount = $request->session()->get('amount');
        // Stripe\Charge::create ([
        //         "amount" => $amount,
        //         "currency" => "Rs",
        //         "source" => $request->stripeToken,
        //         "description" => "Donation to the ProClinic Foundation" 
        // ]);

        /*Test Card*/
        // Name: Test
        // Number: 4242 4242 4242 4242
        // CSV: 123
        // Expiration Month: 12
        // Expiration Year: 2028
      
        Session::flash('success', 'Payment successful!');
        return redirect('/donation');

    }
}
