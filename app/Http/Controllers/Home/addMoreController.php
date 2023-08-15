<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MoreDetails;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
class addMoreController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index($patientId){
        return view('patient.addmore');
    }

    public function update(Request $request, $userId){
        $patient = Patient::where('user_id', $userId)->first();
        $today = Carbon::tomorrow();
        $tommorrow = $today->format('Y-m-d');

        $validator = Validator::make($request->all(), [
            'civil_status' => ['required', 'string', 'max:20'],
            'occupation' => ['required', 'string', 'max:30'],
            'weight' => ['required','numeric',  'between:0,150'],
            'height' => ['required', 'numeric', 'between:0,250'],
            'blood_group' => ['required', 'string', 'max:10'],
            'date' => ['required', 'date', 'before:'.$tommorrow, 'after:2023-01-01'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        else {

            $detail = new MoreDetails();
            $detail->civil_status = $request['civil_status'];
            $detail->occupation = $request['occupation'];
            $detail->weight = $request['weight'];
            $detail->height = $request['height'];
            $detail->blood_group = $request['blood_group'];
            $detail->date = $request['date'];
            $detail->patient_id = $patient->patient_id;
            $detail->smoking = $request['smoking'];
            $detail->save();

            return redirect('/newappointment/'.$userId)->with('success', 'Details Saved!');
        }
    }
}
