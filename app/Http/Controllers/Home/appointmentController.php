<?php

namespace App\Http\Controllers\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use App\Models\Visitings;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class appointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){

        $doctors = Doctor::all();
        $specialities = Doctor::select('specialization')->distinct()->get();
        $isReadonly = false;
        $isVisible = false;
        $name = null;
        $special =null;
        $type = null;
        $days = '';
        $sessionsRegistered = ['Morning'=> false, 'Afternoon'=> false, 'Evening' => false, 'Night' => false];
        return view('patient.appointment', ['doctors' => $doctors, 'specialities'=> $specialities, 'isReadonly' => $isReadonly, 'isVisible'=> $isVisible,
        'selectedDoctorFName' => $name, 'selectedDoctorSpeciality'=> $special, 'type'=> $type, 'days'=> $days, 'session' => $sessionsRegistered]);
    }

    public function update(Request $request, $id){
        if($request->has('form1')){
            $validator = Validator::make($request->all(), [
                'doctor' => 'required',
                'speciality' => 'required',
                'type' => 'required',
            ]);

            if($validator->fails()){
                Session::flash('alert_1', $validator->errors());
                return redirect('/newappointment/{id}');
            }
            else{
                $selectedDoctor = Doctor::where('id', $request['doctor'])->first()->get();
                
                if($request['speciality'] != $selectedDoctor[0]->specialization){
                    Session::flash('alert_1', 'There is No Doctor Registered With that Specialization!');
                    return redirect('/newappointment/{id}');
                }
                else{
                   try{
                        $visitings = Visitings::where('doctor_id', $selectedDoctor[0]->id)->where('type', $request['type'])->get();
                        if(empty($visitings)){
                            Session::flash('alert_1', 'This Doctor did not registered for Appointment Type '.$request['type']);
                            return view('/newappointment/{id}');
                        }
                        else{
                            
                            $patientid = Auth::user()->id;
                            $doctorid = $request['doctor'];
                            $url = route('appointment.check', ['id' => $patientid, 'Id' => $doctorid, 'type' => $request['type']]);
                            return redirect()->to($url);
                        }

                    }                   
                    catch(Exception $ex){
                        Session::flash('alert_1', 'This Doctor did not registered for Appointment Type '.$request['type']);
                        return redirect('/newappointment/{id}');
                    }
                    
                }
            }
        
        }

    }
}
