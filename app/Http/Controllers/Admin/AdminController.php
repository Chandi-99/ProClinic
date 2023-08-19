<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){ 
        if(Auth::check()){
            $user = Auth::user();
            $usertype = $user->usertype;

            if($usertype == 'admin'){
                $today = Carbon::today()->format('y-m-d');
                $thismonth = Carbon::today()->format('m');
                $appointments = Appointment::where('date', $today)->first();
                $patientcount= Patient::all()->count();
                $doctorcount= Doctor::all()->count();
                if(!empty($appointments)){
                    $appointments = Appointment::where('date', $today)->get();
                    $appointmentcount = Appointment::where('date', $today)->count();
                    $bills = Bill::all();
                    $total = 0;  

                    foreach($bills as $bill){
                        $appo = Appointment::where('id', $bill->appo_id)->get();
                        $carbonDate = Carbon::parse($appo[0]->date);
                        $monthofappo = $carbonDate->month;
                        if($monthofappo == $thismonth){
                            $total += $bill->total;
                        }
                        else{
                            continue;
                        }     
                    }

                    return view('admin.admindashboard', ['appointments' => $appointments, 'appointmentcount'=> $appointmentcount, 
                    'patientcount' => $patientcount, 'doctorcount' => $doctorcount, 'total' => $total]);
                }
                else{
                    $appointments = [];
                    $bills = Bill::all();
                    $total = 0;  

                    foreach($bills as $bill){
                        $appo = Appointment::where('id', $bill->appo_id)->first();
                        $carbonDate = Carbon::parse($appo->date);
                        $monthofappo = $carbonDate->month;
                        if($monthofappo == $thismonth){
                            $total += $bill->total;
                        }
                        else{
                            continue;
                        }
                        
                    }
                    return view('admin.admindashboard', ['appointments' => $appointments, 'appointmentcount'=> 0, 
                    'patientcount' => $patientcount, 'doctorcount' => $doctorcount, 'total' => $total]);
                }
                
            }
            else if($usertype == 'staff'){
                return redirect('/staff');
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
