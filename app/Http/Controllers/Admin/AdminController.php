<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $usertype = Auth::user()->usertype;
        
        if($usertype == 'patient'){
            return view('patient.home');
        }
        else if($usertype == 'staff'){
            return view('staff.staffdashboard');
        }
        else{
            return view('admin.admindashboard');
        }
        
    }
}
