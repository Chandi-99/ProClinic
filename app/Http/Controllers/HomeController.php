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

    public function store(array $data){
        
        $temp = Validator::make($data, [
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
            'contact_email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:250'],
        ]);

        $contact = new Contact();
        $contact->fname = $temp['fname'];
        $contact->lname = $temp['lname'];
        $contact->message = $temp['message'];
        $contact->contact_email = $temp['contact_email'];
        $contact->save();

        redirect('contactus');
    }


}
