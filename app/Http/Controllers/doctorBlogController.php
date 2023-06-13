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

class doctorBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if(Auth::user()->usertype == 'doctor'){
            Session('alert_1', '');
            return view('doctorBlog'); 
        }
       
    }

    public function update(Request $request){

        if ($request->has('form1')){
            
            return view('newblog');
        }
        else if($request->has('form2')){

        }
        else if($request->has('form3')){

        }
        else if($request->has('form4')){

            $validator = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
            ]);

            if($validator->fails()){
                Session::flash('alert_1', 'Already Subscribed or Invalid Email Entered!');
                return view('doctorBlog');
            }
            else{
                $email = $request->all()['email'];
                $subscriber = Subscriber::create([
                 'email' => $email
                 ]); 
     
                 if ($subscriber) {
                     Mail::to($email)->send(new Subscribe($email));
                     Session::flash('alert_1', 'Subscription Success! Check Inbox');
                     return view('doctorBlog');
                 }
            }

        }
    }
}
