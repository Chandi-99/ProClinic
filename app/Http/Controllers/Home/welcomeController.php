<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Candidate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class welcomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if($user){

            $usertype = $user->usertype;
            if($usertype == 'admin'){
                return view('adimn.admindashboard');
            }
            else if($usertype == 'staff'){
                return view('staff.staffdashboard');
            }
            else if($usertype == 'patient'){
                return view('patient.home');
            }
        }
        else{
            return view('patient.welcome');
        }
        
    }

    public function store(Request $request){

        if($request->has('form1')){
            $medicine = DB::select('select * from medicines where `medicines`.`medi_name`='.'"'.$request['medicine_name'].'"');
            if($medicine == null){
                return redirect('patient.welcome')->with('alert_1', 'Medicine not found!');
            }
            else{
                return view('patient.searchmedicine',['medi'=>$medicine]);
            }
        }
        if ($request->has('form2')){
            
            $validator = Validator::make($request->all(), [
            'cv_name' => ['required','string', 'max:20'],
            'cv_email' => ['required','string', 'email','max:20'],
            'cv_position' => ['required','string', 'max:20'],
            'cv_aboutme' => ['required','string', 'max:300'],
            'cvfile' => ['required'],
            ]);

            if ($validator->fails()) {
        
                return redirect()->back()->with('alert', 'Only PDF Allowed!');
            }
            else{

                if($request['cvfile']) {

                    $name = $request->cv_name;
                    $path = $request->file('cvfile')->storeAs('cvfiles', $request->file('cvfile')->getClientOriginalName());
                    // Insert record
                    $insertData_arr = array(
                        'cv_name' => $request->cv_name,
                        'cv_email' => $request->cv_email,
                        'cv_position' => $request->cv_position,
                        'cv_aboutme' => $request->cv_aboutme,
                        'cv_file_path' => "cvfiles/".$request->file('cvfile')->getClientOriginalName()
                    );

                    Candidate::create($insertData_arr);
                    return view('patient.CV-Confirmation');

                }

            }
            
        } 
        else if ($request->has('form3')) {

            $temp =  Contact::create([
                'fname' => $request['fname'],
                'lname' => $request['lname'],
                'contact_email' => $request['contact_email'],
                'message' => $request['message'],
            ]);

            $temp->save();
            return view('patient.contactus');
        }

    }
}