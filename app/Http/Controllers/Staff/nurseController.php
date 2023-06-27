<?php

namespace App\Http\Controllers\Staff;
use App\Http\Controllers\Controller;
use App\Models\Nurse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class nurseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        Session::flash('alert_2', '');
        $usertype = Auth::user()->usertype;
            
        if($usertype == 'patient'){
            return view('patient.home');
        }
        else if($usertype == 'admin'){
            return view('admin.admindashboard');
        }
        else if($usertype == 'doctor'){
            return view('doctor.doctordashboard');
        }
        else{ 

            $nurses = Nurse::all();

            return view('staff.newNurse', [
                'nurses' => $nurses,
            ]);
        }
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
            'dob' => ['required', 'date', 'before:1995-01-01', 'after:1943-01-01'],
            'regNum' => ['required', 'string', 'max:15', 'unique:nurses'],
            'gender' => ['required', 'string', 'max:10'],
            'position' => ['required', 'string', 'max:15'],
            'contact' => ['required', 'max:20', 'unique:nurses'],
        ]);


        if ($validator->fails()) {

            $nurses = Nurse::orderByDesc('created_at')->get();
            Session::flash('alert_2', 'Nurse Account Creation Unsuccessful. One or More Inputs are Invalid!');
            
            return view('staff.newNurse', [
                'nurses' => $nurses,
            ]);

        }
        else{     
        
            $nurse = Nurse::create([
                'fname' => $request['fname'],
                'lname'=> $request['lname'],
                'contact'=> $request['contact'],
                'regNum'=> $request['regNum'],
                'position'=> $request['position'],
                'gender'=> $request['gender'],
                'dob'=> $request['dob'],
             ]);

            $nurse->save();  
            $nurses = Nurse::orderByDesc('created_at')->get();

            Session::flash('alert_2', 'Nurse Account Creation Successful!');
            return view('staff.newNurse', [
                'nurses' => $nurses,
            ]);

        }

    }
    
}
