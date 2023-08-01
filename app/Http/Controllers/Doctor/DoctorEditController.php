<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DoctorEditController extends Controller
{
    public function index($userId){
        try{
            $username = User::where('id', $userId)->select('name')->get();
            $doctor = Doctor::where('user_id', $userId)->first()->get();
            return view('doctor.doctoredit',['doctor'=> $doctor, 'username'=>$username]);
        }
        catch(Exception $ex){
            Session::flash('alert_2', "Exception Occured!");
            return redirect('/editDoctor/'.$userId);
        }

    }

    public function update(Request $request, $userId){

        $validator = Validator::make($request->all(), [
            'fname' => ['required', 'string', 'max:20'],
            'lname' => ['required', 'string', 'max:20'],
            'specialization' => ['required', 'string', 'max:15'],
            'echanneling_rate' => ['string','max:4'],
            'normal_rate' => ['required', 'string','max:4'],
            'contact' => ['required', 'max:10', 'min:10'],
        ]);


        if ($validator->fails()) {
            Session::flash('alert_2', $validator->errors());
            return redirect('/editDoctor/'.$userId);
        }
        else{

            if($request['echanneling'] == 'No'){
                $erate = 0;
            }
            else{
                $erate = $request['echanneling_rate'];
            }
        
            $doctor = Doctor::where('user_id', $userId)->first()->get();
            $doctor[0]->fname = $request['fname'];
            $doctor[0]->lname = $request['lname'];
            $doctor[0]->contact = $request['contact'];
            $doctor[0]->echanneling_rate = $erate;
            $doctor[0]->normal_rate = $request['normal_rate'];
            $doctor[0]->specialization = $request['specialization'];
            $doctor[0]->save();

            Session::flash('success', 'Account Information Updated Successfully!');
            return redirect('/editDoctor/'.$userId);

        }
    }
}
