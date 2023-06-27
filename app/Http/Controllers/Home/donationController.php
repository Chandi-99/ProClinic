<?php

namespace App\Http\Controllers\Home;

use NotifyLk\Api\SmsApi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class donationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        //24817
        //daa7GA9cdHQQZ7q7NWDC
        return view('donation');
    }
}
