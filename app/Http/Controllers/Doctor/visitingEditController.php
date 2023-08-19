<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Visitings;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
            return redirect()->back()->withErrors($validator);
        }
        else{
            $data = Visitings::find($visit_id)->first();
            $data->day = $request['day'];
            $data->session = $request['session'];
            $data->type = $request['type'];
            $data->doctor_id = $doctorid;
            $data->max_per_session = $request['max_per_session'];
            $data->save();
            return redirect('/doctor/visitings')->withErrors('success', 'Visiting Information Edited Successfully!');
        }
    }
        
}

