<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\Candidate;
use App\Models\Contact;
use App\Models\Chat;
use Illuminate\Support\Carbon;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){
        if(Auth::check()){
            $usertype = Auth::user()->usertype;
            if($usertype == 'admin'){
                return redirect('/admin');
            }
            else if($usertype == 'staff'){
                $today = Carbon::today()->format('y-m-d');
                $appointments = Appointment::where('date', $today)->first();

                $messagecount = Contact::where('status', 'unread')->first();
                if(!empty($messagecount)){
                    $messagecount = Contact::where('status', 'unread')->count();
                }
                else{
                    $messagecount = 0;
                }

                $textcount = Chat::where('status', 'unread')->where('sender_id', 'patient')->first();
                if(!empty($textcount)){
                    $textcount = Chat::where('status', 'unread')->count();
                }
                else{
                    $textcount = 0;
                }

                $messagecount += $textcount;

                $applicationcount = Candidate::where('status', 'unread')->first();
                if(!empty($applicationcount)){
                    $applicationcount = Candidate::where('status', 'unread')->count();
                }
                else{
                    $applicationcount = 0;
                }

                if(!empty($appointments)){
                    $appointments = Appointment::where('date', $today)->get();
                    $appointmentcount = Appointment::where('date', $today)->count(); 
                    $sessioncount = Appointment::where('date', $today)->select('visiting_id')->distinct()->count();
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
                return redirect('/home');
            }
            else if($usertype == 'doctor'){
                return redirect('/doctor');
            }
        }
        else{
            return redirect('/welcome');
        }
    }
}
