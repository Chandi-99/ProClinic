<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Candidate;
use App\Models\Contact;
use Illuminate\Support\Carbon;

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
                return view('admin.admindashboard');
            }
            else if($usertype == 'staff'){
                $today = Carbon::today()->format('y-m-d');
                $thismonth = Carbon::today()->format('m');
                $appointments = Appointment::where('date', $today)->first();

                $messagecount = Contact::where('status', 'unread')->first();
                if(!empty($messagecount)){
                    $messagecount = Contact::where('status', 'unread')->get();
                }
                else{
                    $messagecount = 0;
                }

                $applicationcount = Candidate::where('status', 'unread')->first();
                if(!empty($applicationcount)){
                    $applicationcount = Candidate::where('status', 'unread')->get();
                }
                else{
                    $applicationcount = 0;
                }

                if(!empty($appointments)){
                    $appointments = Appointment::where('date', $today)->get();
                    $appointmentcount = Appointment::where('date', $today)->count(); 
                    $sessioncount = Appointment::where('date', $today)->select('visiting_id')->distinct()->get();

                    return view('staff.staffdashboard', ['appointments' => $appointments, 'appointmentcount'=> $appointmentcount, 
                    'sessioncount' => $sessioncount, 'messagecount' => $messagecount, 'applicationcount' => $applicationcount]);
                }
                else{
                    $appointments = [];
                    $sessioncount = 0;
                    $appointmentcount = 0;
                    return view('staff.staffdashboard', ['appointments' => $appointments, 'appointmentcount'=> $appointmentcount, 
                    'sessioncount' => $sessioncount, 'messagecount' => $messagecount, 'applicationcount' => $applicationcount]);
                }
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
