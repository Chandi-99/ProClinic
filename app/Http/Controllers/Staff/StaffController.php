<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        $user = Auth::user();
        if($user){
            $usertype = $user->usertype;
            if($usertype == 'admin'){
                return view('adimn.admindashboard');
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
