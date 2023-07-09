<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        $user = Auth::user();
        if($user){
            $usertype = $user->usertype;
            if($usertype == 'admin'){
                return view('admin.admindashboard');
            }
            else if($usertype == 'staff'){
                return view('staff.staffdashboard');
            }
            else if($usertype == 'patient'){
                Session::flash('alert_1', '');
                Session::flash('alert_2', '');
                return view('patient.home');
            }
            else if($usertype == 'doctor'){
                return view('doctor.doctordashboard');
            }
        }
        else{
            Session::flash('alert_1', '');
            Session::flash('alert_2', '');
            return view('patient.welcome');
        }
    }
}
