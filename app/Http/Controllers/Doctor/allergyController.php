<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Allergy;
use Illuminate\Support\Facades\Validator;

class allergyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($patientId)
    {
        $allergies = Allergy::where('patient_id', $patientId)->count();
        if ($allergies > 0) {
            $allergies = Allergy::where('patient_id', $patientId)->get();
        } else {
            $allergies = null;
        }
        return view('doctor.newallergy', ['patientId' => $patientId, 'allergies' => $allergies]);
    }

    public function update(Request $request, $patientId)
    {
        $validator = Validator::make($request->all(), [
            'allergy' => ['required', 'string', 'max:30'],
            'status' => ['required', 'string', 'max:40'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $allergy = new Allergy();
            $allergy->allergy = $request['allergy'];
            $allergy->status = $request['status'];
            $allergy->patient_id = $patientId;
            $allergy->save();

            return redirect('/newAllergy/' . $patientId)->with('success', 'New Allergy Recorded!');
        }
    }
}
