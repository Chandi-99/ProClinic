<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use App\Models\Visitings;
use App\Models\Holiday;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class appointmentNextController extends Controller
{
    public function index(int $patient_id, int $doctor_id){
        $alldays = Visitings::where('doctor_id', $doctor_id)->select('day')->distinct()->orderBy('day', 'asc')->get();
        $days = '';
        foreach($alldays as $day){
            $days = $days.$day->day.' ';
        }
        $sessionsRegistered = ['Morning'=> false, 'Afternoon'=> false, 'Evening' => false, 'Night' => false];
        $sessions = Visitings::where('doctor_id', $doctor_id)->select('session')->distinct()->get();

        foreach($sessions as $session){
            if($session->session == 'Morning'){
                $sessionsRegistered['Morning'] = true;
            }
            else if($session->session == 'Afternoon'){
                $sessionsRegistered['Afternoon'] = true;
            }
            else if
            ($session->session == 'Evening'){
                $sessionsRegistered['Evening'] = true;
            }
            else if($session->session == 'Night'){
                $sessionsRegistered['Night'] = true;
            }
        }
        return view('patient.appointmentNext' , ['days' => $days]);
    }

    public function check(Request $request, $patient_id, $doctor_id){
        $alldays = Visitings::where('doctor_id', $doctor_id)->select('day')->distinct()->orderBy('day', 'asc')->get();
        $days = '';
        foreach($alldays as $day){
            $days = $days.$day->day.' ';
        }

        $sessionsRegistered = ['Morning'=> false, 'Afternoon'=> false, 'Evening' => false, 'Night' => false];
        $sessions = Visitings::where('doctor_id',$doctor_id)->select('session')->distinct()->get();

        foreach($sessions as $session){
            if($session->session == 'Morning'){
                $sessionsRegistered['Morning'] = true;
            }
            else if($session->session == 'Afternoon'){
                $sessionsRegistered['Afternoon'] = true;
            }
            else if
            ($session->session == 'Evening'){
                $sessionsRegistered['Evening'] = true;
            }
            else if($session->session == 'Night'){
                $sessionsRegistered['Night'] = true;
            }
        }

        $validator = Validator::make($request->all(), [
            'date' => ['required', 'date', 'after_or_equal:today', 'within_30_days'],
        ]);

        if($validator->fails()){
            Session::flash('alert_3', $validator->errors());
            
            return view('patient.appointmentNext', ['days'=> $days]);
        }
        else{
            try{
                $holidays = Holiday::all();
                foreach($holidays as $holiday){
                    if($holiday == $request['date']){
                        
                        Session::flash('alert_3','Sorry! We are closed on '. $holiday->date);
                        return view('patient.appointmentNext', ['days'=> $days]);
                    }
                }

                $dayoftheSelectedDate = Carbon::parse($request['date']);
                $dayOfWeek = $dayoftheSelectedDate->format('l');
                
                $alldays = Visitings::where('doctor_id', $doctor_id)->select('day')->distinct()->orderBy('day', 'asc')->get();
                foreach($alldays as $day){
                    if($day->day == $dayOfWeek){
                        $sessions = Visitings::where('day', $dayOfWeek)->where('doctor_id', $doctor_id)->get();
                        return view('patient.appointmentNext', ['days'=> $days]);
                    }
                }

                Session::flash('alert_3', 'Doctor is Unavailable on that date');
                return view('patient.appointmentNext', ['days'=> $days]);
            }
            catch(Exception $ex){
                Session::flash('alert_3', $ex);
            }
        }
        
    }
}
