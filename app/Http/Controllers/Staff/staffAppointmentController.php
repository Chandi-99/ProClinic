<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Visitings;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class staffAppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $doctors = Doctor::all();
        $patient = Patient::all();
        $specialities = Doctor::select('specialization')->distinct()->get();
        $isReadonly = false;
        $isVisible = false;
        $name = null;
        $special =null;
        $type = null;
        $days = '';
        $sessionsRegistered = ['Morning'=> false, 'Afternoon'=> false, 'Evening' => false, 'Night' => false];
         
        return view('staff.staffappointment', ['doctors' => $doctors, 'specialities'=> $specialities, 'isReadonly' => $isReadonly, 'isVisible'=> $isVisible,
        'selectedDoctorFName' => $name, 'selectedDoctorSpeciality'=> $special, 'type'=> $type, 'days'=> $days, 'session' => $sessionsRegistered, 'patients' => $patient]);
    }

    public function update(Request $request){
        if($request->has('form1')){
            $validator = Validator::make($request->all(), [
                'patient' => 'required',
                'doctor' => 'required',
                'speciality' => 'required',
                'type' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }
            else{
                $values = explode(' ', $request['doctor']);
                $selectedDoctor = Doctor::where('fname', $values[0])->where('lname', $values[1])->first()->get();
                
                if($request['speciality'] != $selectedDoctor[0]->specialization){
                    return redirect()->back()->with('error','There is No Doctor Registered With that Specialization!' );
                }
                else{
                   try{ 
                      
                        $visitings = Visitings::where('doctor_id', $selectedDoctor[0]->id)->where('type', $request['type'])->get();
                        if(empty($visitings)){
                            return redirect()->back()->with('error','This Doctor did not registered for Appointment Type '.$request['type'] );
                        }
                        else{
                            
                            $patient = Patient::where('user_id',$request['patient'])->get();
                            $doctorid = $selectedDoctor[0]->id;
                            $url = route('staffappointment.check', ['id' => $patient[0]->patient_id, 'Id' => $doctorid, 'type' => $request['type']]);
                            return redirect()->to($url);
                        }

                    }                   
                    catch(Exception $ex){
                        return redirect()->back()->with('error','This Doctor did not registered for Appointment Type '.$request['type'] );
                    }
                    
                }
            }
        
        }

    }
}
