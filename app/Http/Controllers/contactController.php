<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class contactController extends Controller
{
    public function index()
    {
        return view('welcome');
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
