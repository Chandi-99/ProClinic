<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class IncomingAppoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($patientID){
        $appointments = Appointment::where('patient_id', $patientID)
                                    ->where('status',"Pending")
                                    ->get();
        $today = Carbon::today();
        //dd($today->format('Y-m-d'));
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
                //look for a link in new data table appointment_link
                
            }
            else if($i > $appointment[0]->appo_number ){
                $status = "Current Appointment Number is ".$i. ". Please Contact Staff member if you unable to attend to the appointment";
            }

            Session::flash('success', $status);
            return redirect('incomingappointments/'.$userID);
        }
    }
}
