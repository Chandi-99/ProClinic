<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Models\Medicine;
use Faker\Provider\Medical;

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
            Session::flash('alert_1', $validator->errors());
            return redirect('/medicine');
        }
        else{
                
            $data = Medicine::find($medi_id)->get();
            $data[0]->mg = $request['weight'];
            $data[0]->company = $request['company'];
            $data[0]->availability = $request['availability'];
            $data[0]->after_eat = $request['after_eat'];
            $data[0]->uses = $request['uses'];
            $data[0]->side_effects = $request['side_effects'];
            $data[0]->precautions = $request['precautions'];
            $data[0]->overdose = $request['over_dose'];
            $data[0]->howtouse = $request['howtouse'];
            $data[0]->unit_price = $request['unit_price'];
            $data[0]->save();
            return redirect('/medicine');
               
        }
        
    }

    public function delete(int $id){
        
        $medicine = Medicine::find($id)->get();
        $medicine->each->delete();
        $medicine = Medicine::all();
        return view('staff.medicine',['medicines'=>$medicine]);
    }

}
        

