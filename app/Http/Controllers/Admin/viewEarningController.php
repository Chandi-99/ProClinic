<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class viewEarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'patient') {
            return view('patient.home');
        } else if ($usertype == 'admin') {
            return view('admin.earningview');
        } else if ($usertype == 'doctor') {
            return view('doctor.doctordashboard');
        } else {
            return view('staff.staffdashboard');
        }
    }

    public function search(Request $request){

    }

    public function thismonth(){

    }

    public function overall(){

    }
}
