<?php

namespace App\Http\Controllers\Staff;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class doctorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('staff.newdoctor');
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
            'dob' => ['required', 'date', 'before:1995-01-01', 'after:1943-01-01'],
            'regNum' => ['required', 'string', 'max:15', 'unique:doctors'],
            'gender' => ['required', 'string', 'max:10'],
            'specialization' => ['required', 'string', 'max:15'],
            'echanneling_rate' => ['string','max:4'],
            'normal_rate' => ['required', 'string','max:4'],
            'contact' => ['required', 'max:20', 'unique:doctors'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($validator->fails()) {
            //->withErrors($validator);
            return view('staff.newdoctor')->with('alert_2', 'Doctor Account Creation Unsuccessful. One or More Inputs are Invalid!'); 
        }
        else{     
            
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'usertype' => "doctor",
                'password' => Hash::make($request['password']),
            ]);

            $user->save();
            $userid = DB::connection()->getPdo()->lastInsertId();

            if($request['echanneling_rate'] == null){
                $erate = 0;
            }
            else{
                $erate = $request['echanneling_rate'];
            }
        
            $doctor = Doctor::create([
                'fname' => $request['fname'],
                'lname'=> $request['lname'],
                'contact'=> $request['contact'],
                'regNum'=> $request['regNum'],
                'echanneling_rate'=> $erate,
                'normal_rate'=> $request['normal_rate'],
                'specialization'=> $request['specialization'],
                'gender'=> $request['gender'],
                'dob'=> $request['dob'],
                'user_id' => $userid,
             ]);

            $doctor->save();
            
            return view('staff.newdoctor');

        }
    }
}
