<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class donationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        Session::flash('alert_01', '');
        
        return view('patient.donation');
    }

    public function donate(Request $request){

        $amount = 0;
        if($request['amount'] || $request['custom_amount']){
            if($request['amount'] && $request['custom_amount']){
                $validator = Validator::make($request->all(), [
                    'custom_amount' => 'required',
                    'donation-name' => 'required',
                    'donation-email' => 'required',
                    'DonationPayment' => 'required|in:debitcard'
                ]);
                $amount=$request['custom_amount'];

            }
            else{
                $validator = Validator::make($request->all(), [
                    'amount' => 'required|in:10,15,20,30,45,50',
                    'donation-name' => 'required',
                    'donation-email' => 'required',
                    'DonationPayment' => 'required|in:debitcard'
                ]);
                $amount=$request['amount'];
            }
        }

        if($validator->fails()){
            Session::flash('alert_01', $validator->error());
            return view('patient.donation');
        }
        else{
            return redirect()->route('payment')->with(['name'=> $request['donation-name'], 'email' => $request['donation-email'], 'amount' => $amount]);
        }
        
    }
}
