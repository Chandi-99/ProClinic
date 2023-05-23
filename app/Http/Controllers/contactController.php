<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Candidate;

class contactController extends Controller
{
    public function index()
    {
        return view('welcome');

        // Fetch all records
        /*
        $Candidate = Candidate::select('*')->get();

        $data['Candidate'] = $Candidate;
        
        return view('index',$data);
        */
    }

    public function store(Request $request){

        if($request->has('form1')){

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

                    $path = $request->file('cvfile')->store('cvfiles');

                    // Insert record
                    $insertData_arr = array(
                        'cv_name' => $request->cv_name,
                        'cv_email' => $request->cv_email,
                        'cv_position' => $request->cv_position,
                        'cv_aboutme' => $request->cv_aboutme,
                        'cv_file_path' => "cvfiles/".$request->file('cvfile')->getClientOriginalName()
                    );

                    Candidate::create($insertData_arr);

                    // Session
                    //Session::flash('alert-class', 'alert-success');
                    //Session::flash('message','Record inserted successfully.');

                    return view('CV-Confirmation');

                }
                else{

                    // Session
                    //Session::flash('alert-class', 'alert-danger');
                    //Session::flash('message','Record not inserted');
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
            return view('contactus');
        }

    }
}
