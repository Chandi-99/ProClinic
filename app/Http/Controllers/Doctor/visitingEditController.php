<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visitings;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class visitingEditController extends Controller
{
    public function index($id){

        $visit = Visitings::where('id', $id)->get();
        return view('doctor.visitingedit',['visit' => $visit]);
    }

    public function update(Request $request, int $visit_id){

        $user = User::find(Auth::user()->id);
        $doctorid = $user->Doctor->id;

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'max_per_session' => 'required',  
        ]);

        if($validator->fails()){
            Session::flash('alert_2', $validator->errors());
            return redirect('/doctor/visitings');
        }
        else{
            $data = Visitings::find($visit_id)->get();
            $data[0]->day = $request['day'];
            $data[0]->session = $request['session'];
            $data[0]->type = $request['type'];
            $data[0]->doctor_id = $doctorid;
            $data[0]->max_per_session = $request['max_per_session'];
            $data[0]->save();

            Session::flash('alert_1', 'Visiting Information Edited Successfully!');
            return redirect('/doctor/visitings');
            

        }
    }
        
}

