<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class patientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('staff.newpatient');
    }

    public function create(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:20'],
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:50'],
            'dob' => ['required', 'date', 'before:today', 'after:1923-01-01'],
            'gender' => ['required', 'string', 'max:10'],
            'nic' => ['required', 'string', 'min:10','max:12', 'unique:users'],
            'contact' => ['required', 'max:20', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($validator->fails()) {
            //->withErrors($validator);
            return view('staff.newpatient')->with('alert_2', 'Patient Account Creation Unsuccessful. One or More Inputs are Invalid!'); 
        }
        else{     
            
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'usertype' => "patient",
                'password' => Hash::make($request['password']),
            ]);

            $user->save();
            $userid = DB::connection()->getPdo()->lastInsertId();
        
            $patient = Patient::create([
                'fname' => $request['fname'],
                'lname'=> $request['lname'],
                'contact'=> $request['contact'],
                'nic'=> $request['nic'],
                'address'=> $request['address'],
                'gender'=> $request['gender'],
                'dob'=> $request['dob'],
                'user_id' => $userid,
             ]);

            $patient->save();
            return view('staff.newpatient')->with('alert_2', 'Patient Account Creation successful!'); 

        }
    }

}
