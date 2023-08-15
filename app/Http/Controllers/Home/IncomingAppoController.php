<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Appointment;
use App\Models\AppointmentLink;
use App\Models\Patient;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class IncomingAppoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($userId){
        $patient = Patient::where('user_id',$userId)->first();
        $appointments = Appointment::where('patient_id', $patient->patient_id)->where('status','pending')->get();
        $today = Carbon::today();
        return view('patient.incomingappointments',['appointments'=> $appointments, 'today'=> $today->format('Y-m-d')]);
    }

    public function update($patientID, $appoID){

    }

    public function check($userID, $appoID){
        $appointment = Appointment::where('id', $appoID)->get();
        $visitingId = $appointment[0]->visiting_id;
        $allSessionAppointments = Appointment::where('visiting_id', $visitingId)->where('date', $appointment[0]->date)->orderBy('appo_number', 'asc')->get();
        $i = 0;
        foreach($allSessionAppointments as $temp){
            if($temp->status == 'Finished'){
                continue;
            }
            if($temp->status == 'Pending'){
                $i = $temp->appo_number;
            }
        }

        if($i == 0){
            $i =1;
        }
        if($i < $appointment[0]->appo_number){
            $status = "Current Appointment Number is ".$i. ". Wait till your turn!";
        }
        else if($i == $appointment[0]->appo_number ){
            $status = "Current Appointment Number is ".$i. ". It is your Number. Please Immediatly report to the ".$appointment[0]->Visiting->Room->room_name;
        }
        else if($i > $appointment[0]->appo_number ){
            $status = "Current Appointment Number is ".$i. ". Please Contact Staff member if you unable to attend to the appointment";
        }

        Session::flash('success', $status);
        return redirect('incomingappointments/'.$userID);
    }

    public function join($userID, $appoID){
        $appointment = Appointment::where('id', $appoID)->get();
        $visitingId = $appointment[0]->visiting_id;
        $allSessionAppointments = Appointment::where('visiting_id', $visitingId)->where('date', $appointment[0]->date)->orderBy('appo_number', 'asc')->get();
        $i = 0;
        foreach($allSessionAppointments as $temp){
            if($temp->status == 'Finished'){
                continue;
            }
            if($temp->status == 'Pending'){
                $i = $temp->appo_number;
            }

            if($i == 0){
                $i =1;
            }
            if($i < $appointment[0]->appo_number){
                $status = "Current Appointment Number is ".$i. ". Wait till your turn!";
            }
            else if($i == $appointment[0]->appo_number ){
                $status = "Current Appointment Number is ".$i. ". It is your Number. Please Immediatly report to the ".$appointment[0]->Visiting->Room->room_name;
                $today = Carbon::now();
                $date = $today->format('Y-m-d');
                $link = AppointmentLink::where('visiting_id', $visitingId)->where('date', $date)->first();
                if(isset($link)){
                    return redirect($link->link);
                }
                else{
                    return redirect()->back()->with('error', 'Link Not Found!. Please Immediatly Contact the Medical Center!');
                }
                
            }
            else if($i > $appointment[0]->appo_number ){
                $status = "Current Appointment Number is ".$i. ". Please Contact Staff member if you unable to attend to the appointment";
            }

            Session::flash('success', $status);
            return redirect('incomingappointments/'.$userID);
        }
    }
}
