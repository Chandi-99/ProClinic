<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function store(Request $request){
        $temp =  Contact::create([
            'fname' => $request['fname'],
            'lname' => $request['lname'],
            'contact_email' => $request['contact_email'],
            'message' => $request['message'],
        ]);
        $temp->save();
        return view('contactus');
    }


}
