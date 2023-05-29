<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $usertype = Auth::user()->usertype;
        
        if($usertype == 'patient'){
            return view('home');
        }
        else if($usertype == 'staff'){
            return view('staffdashboard');
        }
        else{
            return view('admindashboard');
        }
        
    }
}
