<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Medicine;

class medicineEditController extends Controller
{
    public function index(int $id){
        $medicine = Medicine::where('id', $id)->get();
        return view('staff.medicineEdit', ['medicines' => $medicine]);
    }

    public function edit(Request $request, int $medi_id){
        $validator = Validator::make($request->all(), [
            'weight' => 'required',
            'company' => 'required',
            'availability' => 'required',
            'after_eat' => 'required',
            'uses' => 'required',
            'howtouse' => 'required',
            'precautions' => 'required',
            'side_effects' => 'required',
            'over_dose' => 'required',
            'weight' => ['required'],
            'unit_price' => ['required'],    
        ]);

        if($validator->fails()){
            return redirect('/medicine')->withErrors($validator);
        }
        else{     
            $data = Medicine::find($medi_id)->first();
            $data->mg = $request['weight'];
            $data->company = $request['company'];
            $data->availability = $request['availability'];
            $data->after_eat = $request['after_eat'];
            $data->uses = $request['uses'];
            $data->side_effects = $request['side_effects'];
            $data->precautions = $request['precautions'];
            $data->overdose = $request['over_dose'];
            $data->howtouse = $request['howtouse'];
            $data->unit_price = $request['unit_price'];
            $data->save();
            return redirect('/medicine')->with('success', 'Information Changed Successfully!');     
        }
    }

    public function delete(int $id){ 
        $medicine = Medicine::find($id)->get();
        $medicine->each->delete();
        $medicine = Medicine::all();
        return view('staff.medicine',['medicines'=>$medicine]);
    }
}
        

