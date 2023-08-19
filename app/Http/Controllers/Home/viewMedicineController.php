<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class viewMedicineController extends Controller
{
    public function index($mediId){
        $medicine = Medicine::where('id', $mediId)->get();
        return view('patient.searchmedicine',['medi'=>$medicine]);
    }

    public function search(Request $request){
        $validator = Validator::make($request->all(),[
            'medicine_name' => ['required','string', 'max:30']
        ]);

        if($validator->fails()){
            return redirect()->back()->with('error', "No medicine Found for that Name");
        }
        else{
            $medicine = Medicine::where('medi_name', $request['medicine_name'])->count();

            if($medicine > 0){
                $medicine = Medicine::where('medi_name', $request['medicine_name'])->first();
                return redirect('/viewmedicine/'.$medicine->id)->with('success', 'Medicine Found!');
            }
            else{
                return redirect()->back()->with('error', "No medicine Found for that Name");
            }
        }

    }
}
