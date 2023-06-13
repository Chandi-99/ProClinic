<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\Subscribe;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class blogController extends Controller
{
    public function index(){
        Session('alert_1', '');
        return view('blog'); 
    }

    public function update(Request $request){

        if ($request->has('form1')){
            
            return view('newblog');
        }
        else if($request->has('form2')){

        }
        else if($request->has('form3')){

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
            ]);
            if($validator->fails()){
                Session::flash('alert_1', 'Already Subscribed or Invalid Email Entered!');
                return view('blog');
            }
            else{
                $email = $request->all()['email'];
                $subscriber = Subscriber::create([
                 'email' => $email
                 ]); 
     
                 if ($subscriber) {
                     Mail::to($email)->send(new Subscribe($email));
                     Session::flash('alert_1', 'Subscription Success! Check Inbox');
                     return view('blog');
                 }
            }

        }

    }
}
