<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Http\Request;
use App\Models\Medicine;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class medicineController extends Controller
{
    public function index(){
        $medicine = Medicine::all();
        //$medicines = Medicine::withTrashed()->get();
        Session::flash('alert_1', '');
        return view('staff.medicine',['medicines'=>$medicine]);
    }

    public function update(Request $request){

        if ($request->has('form2')){
            $validator = Validator::make($request->all(), [
                'image' => 'required|file|mimes:jpeg,jpg,png|max:2048',
                'weight' => 'required',
                'company' => 'required',
                'availability' => 'required',
                'after_eat' => 'required',
                'uses' => 'required',
                'howtouse' => 'required',
                'precautions' => 'required',
                'side_effects' => 'required',
                'over_dose' => 'required',
                'medi_name' => 'required| unique:medicines',
                'weight' => ['required'],
                'unit_price' => ['required'],    
            ]);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator);
            }
            else{
                if($request['image']) {
                    $data= new Medicine();
                    $file= $request->file('image');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/MediImages'), $filename);
                    $data->image=$filename;
                    $data->medi_name = $request['medi_name'];
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
                    
                    return redirect('/medicine');
                }
    
            }
        }
    }
    
}
