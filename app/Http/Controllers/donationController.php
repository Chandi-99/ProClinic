<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class donationController extends Controller
{
    public function index(){
        return view('donation');
    }
}
