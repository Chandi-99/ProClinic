<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Allergy;
use App\Models\Appointment;
use App\Models\Bill;
use App\Models\Diagnosis;
use App\Models\Medicine;
use App\Models\MoreDetails;
use App\Models\Prescription;
use App\Models\Prescription_Medicine;
use App\Models\Visitings;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class DiagnosisController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($visitingId, $appointmentId)
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == 'patient') {
            return redirect('/home');
        } else if ($usertype == 'admin') {
            return redirect('/admin');
        } else if ($usertype == 'doctor') {

            $today = Carbon::today();
            $today = $today->format('Y-m-d');

            $medicines = Medicine::all();
            $mediassigned = null;

            $visiting = Visitings::find($visitingId);
            $appointment = Appointment::find($appointmentId);
            $patient = $appointment->Patient();

            $bill = Bill::where('appo_id', $appointment->id)->first();
            $prescription = Prescription::where('appo_id', $appointment->id)->first();

            $latests = Appointment::where('patient_id', $appointment->patient_id)->where('status', 'finished')->where('date', '<', now()->toDateString())->count();
            if ($latests > 0) {
                $latests = Appointment::where('date', '<', now()->toDateString())->get();
            } else {
                $latests = null;
            }

            $allergies = Allergy::where('patient_id', $patient->patient_id)->count();
            if ($allergies > 0) {
                $allergies = Allergy::where('patient_id', $patient->patient_id)->get();
            } else {
                $allergies = null;
            }

            $vitalSigns = MoreDetails::where('patient_id', $patient->patient_id)->count();
            if ($vitalSigns > 0) {
                $vitalSigns = MoreDetails::where('patient_id', $patient->patient_id)->first();
                $bmi = ($vitalSigns->weight / (($vitalSigns->height / 100) * ($vitalSigns->height / 100)));
                $bmi = round($bmi, 2);
                if ($bmi < 18.5) {
                    $weightStatus = "Underweight";
                } elseif ($bmi < 25) {
                    $weightStatus = "Normal weight";
                } elseif ($bmi < 30) {
                    $weightStatus = "Overweight";
                } elseif ($bmi < 35) {
                    $weightStatus = "Obesity Class I";
                } elseif ($bmi < 40) {
                    $weightStatus = "Obesity Class II";
                } else {
                    $weightStatus = "Obesity Class III (Severe Obesity)";
                }
                $bmi = $bmi . ' (' . $weightStatus . ')';
            } else {
                $vitalSigns = null;
            }

            return view('doctor.diagnosis', [
                'patient' => $patient, 'bill' => $bill, 'prescription' => $prescription, 'appointment' => $appointment, 'vitalSigns' => $vitalSigns, 'allergies' => $allergies,
                'medicines' => $medicines, 'visiting' => $visiting, 'mediassigned' => $mediassigned, 'latests' => $latests, 'hidden' => true, 'bmi' => $bmi,
            ]);
        } else {
            return redirect('/staff');
        }
    }

    public function update(Request $request, $visitingId, $appointmentId)
    {
        $validator = Validator::make($request->all(), [
            'chief_complain' => ['required', 'string', 'max:100'],
            'symptoms' => ['required', 'string', 'max:100'],
            'physical_examination' => ['required', 'string', 'max:200'],
            'recommended_tests' => ['required', 'string', 'max:100'],
            'identified_disease' => ['required', 'string', 'max:100'],
            'blood_pressure' => ['required', 'string', 'max:6'],
            'blood_sugar_level' => ['required', 'string', 'max:3'],
            'rest_no_days' =>  ['required', 'string', 'max:2']
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {

            $diagnosis = new Diagnosis();
            $diagnosis->chief_complain = $request['chief_complain'];
            $diagnosis->symptoms = $request['symptoms'];
            $diagnosis->physical_examination = $request['physical_examination'];
            $diagnosis->recommended_tests = $request['recommended_tests'];
            $diagnosis->identified_disease = $request['identified_disease'];
            $diagnosis->blood_pressure = $request['blood_pressure'];
            $diagnosis->blood_sugar_level = $request['blood_sugar_level'];
            $diagnosis->rest_no_days = $request['rest_no_days'];
            $diagnosis->appo_id = $appointmentId;
            $diagnosis->save();

            $today = Carbon::today();
            $today = $today->format('Y-m-d');
            $medicines = Medicine::all();

            $mediassigned = null;
            $visiting = Visitings::find($visitingId);

            $appointment = Appointment::find($appointmentId);
            $patient = $appointment->Patient();
            $bill = Bill::where('appo_id', $appointment->id)->get();
            $prescription = Prescription::where('appo_id', $appointment->id)->get();
            $allergies = Allergy::where('patient_id', $patient->patient_id)->count();
            if ($allergies > 0) {
                $allergies = Allergy::where('patient_id', $patient->patient_id)->get();
            } else {
                $allergies = null;
            }

            $vitalSigns = MoreDetails::where('patient_id', $patient->patient_id)->count();

            if ($vitalSigns > 0) {
                $vitalSigns = MoreDetails::where('patient_id', $patient->patient_id)->first();
                $bmi = ($vitalSigns->weight / (($vitalSigns->height / 100) * ($vitalSigns->height / 100)));
                $bmi = round($bmi, 2);
                if ($bmi < 18.5) {
                    $weightStatus = "Underweight";
                } elseif ($bmi < 25) {
                    $weightStatus = "Normal weight";
                } elseif ($bmi < 30) {
                    $weightStatus = "Overweight";
                } elseif ($bmi < 35) {
                    $weightStatus = "Obesity Class I";
                } elseif ($bmi < 40) {
                    $weightStatus = "Obesity Class II";
                } else {
                    $weightStatus = "Obesity Class III (Severe Obesity)";
                }
                $bmi = $bmi . ' (' . $weightStatus . ')';
            } else {
                $vitalSigns = null;
            }

            return view('doctor.diagnosis', [
                'patient' => $patient, 'bill' => $bill[0], 'prescription' => $prescription[0], 'appointment' => $appointment, 'vitalSigns' => $vitalSigns,
                'medicines' => $medicines, 'visiting' => $visiting, 'mediassigned' => $mediassigned, 'hidden' => false, 'bmi' => $bmi, 'allergies' => $allergies
            ]);
        }
    }

    public function addMedicine(Request $request, $prescriptionId, $visitingId, $appointmentId)
    {

        $validator = Validator::make($request->all(), [
            'medicine_id' => ['required'],
            'quantity' => ['required', 'max:100'],
            'dose' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {

            $temp = Prescription_Medicine::where('medi_id', $request['medicine_id'])->where('prescription_id', $prescriptionId)->count();

            if (!$temp > 0) {
                $tempMedi = new Prescription_Medicine();
                $tempMedi->medi_id = $request['medicine_id'];
                $tempMedi->prescription_id = $prescriptionId;
                $tempMedi->quantity = $request['quantity'];
                $tempMedi->dose = $request['dose'];
                $tempMedi->save();
            }


            $medicines = Medicine::all();
            $today = Carbon::today();
            $today = $today->format('Y-m-d');

            $mediassigned = Prescription_Medicine::where('prescription_id', $prescriptionId)->count();
            if ($mediassigned > 0) {
                $mediassigned = Prescription_Medicine::where('prescription_id', $prescriptionId)->get();
            } else {
                $mediassigned = null;
            }

            $visiting = Visitings::find($visitingId);
            $appointment = Appointment::find($appointmentId);
            $patient = $appointment->Patient();
            $bill = Bill::where('appo_id', $appointment->id)->get();
            $prescription = Prescription::find($prescriptionId);
            $allergies = Allergy::where('patient_id', $patient->patient_id)->count();
            if ($allergies > 0) {
                $allergies = Allergy::where('patient_id', $patient->patient_id)->get();
            } else {
                $allergies = null;
            }

            $vitalSigns = MoreDetails::where('patient_id', $patient->patient_id)->count();
            if ($vitalSigns > 0) {
                $vitalSigns = MoreDetails::where('patient_id', $patient->patient_id)->first();
                $bmi = ($vitalSigns->weight / (($vitalSigns->height / 100) * ($vitalSigns->height / 100)));
                $bmi = round($bmi, 2);
                if ($bmi < 18.5) {
                    $weightStatus = "Underweight";
                } elseif ($bmi < 25) {
                    $weightStatus = "Normal weight";
                } elseif ($bmi < 30) {
                    $weightStatus = "Overweight";
                } elseif ($bmi < 35) {
                    $weightStatus = "Obesity Class I";
                } elseif ($bmi < 40) {
                    $weightStatus = "Obesity Class II";
                } else {
                    $weightStatus = "Obesity Class III (Severe Obesity)";
                }
                $bmi = $bmi . ' (' . $weightStatus . ')';
            } else {
                $vitalSigns = null;
            }

            return view('doctor.diagnosis', [
                'patient' => $patient, 'bill' => $bill[0], 'prescription' => $prescription, 'appointment' => $appointment, 'bmi' => $bmi, 'allergies' => $allergies,
                'medicines' => $medicines, 'visiting' => $visiting, 'mediassigned' => $mediassigned, 'hidden' => false, 'vitalSigns' => $vitalSigns,
            ])->with('error', 'Medicine Already Assigned!');
        }
    }

    public function removeMedicine($visitingId, $prescriptionId, $mediId)
    {

        $temp = Prescription_Medicine::where('prescription_id', $prescriptionId)->where('medi_id', $mediId)->first();
        $temp->delete();

        $medicines = Medicine::all();
        $today = Carbon::today();
        $today = $today->format('Y-m-d');

        $mediassigned = Prescription_Medicine::where('prescription_id', $prescriptionId)->count();
        if ($mediassigned > 0) {
            $mediassigned = Prescription_Medicine::where('prescription_id', $prescriptionId)->get();
        } else {
            $mediassigned = null;
        }

        $visiting = Visitings::find($visitingId);
        $appointment = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->first();
        $patient = $appointment->Patient();
        $bill = Bill::where('appo_id', $appointment->id)->first();
        $prescription = Prescription::find($prescriptionId);
        $allergies = Allergy::where('patient_id', $patient->patient_id)->count();
        if ($allergies > 0) {
            $allergies = Allergy::where('patient_id', $patient->patient_id)->get();
        } else {
            $allergies = null;
        }

        $vitalSigns = MoreDetails::where('patient_id', $patient->patient_id)->count();
        if ($vitalSigns > 0) {
            $vitalSigns = MoreDetails::where('patient_id', $patient->patient_id)->first();
            $bmi = ($vitalSigns->weight / (($vitalSigns->height / 100) * ($vitalSigns->height / 100)));
            $bmi = round($bmi, 2);
            if ($bmi < 18.5) {
                $weightStatus = "Underweight";
            } elseif ($bmi < 25) {
                $weightStatus = "Normal weight";
            } elseif ($bmi < 30) {
                $weightStatus = "Overweight";
            } elseif ($bmi < 35) {
                $weightStatus = "Obesity Class I";
            } elseif ($bmi < 40) {
                $weightStatus = "Obesity Class II";
            } else {
                $weightStatus = "Obesity Class III (Severe Obesity)";
            }
            $bmi = $bmi . ' (' . $weightStatus . ')';
        } else {
            $vitalSigns = null;
        }

        return view('doctor.diagnosis', [
            'patient' => $patient, 'bill' => $bill, 'prescription' => $prescription, 'appointment' => $appointment, 'bmi' => $bmi, 'allergies' => $allergies,
            'medicines' => $medicines, 'visiting' => $visiting, 'mediassigned' => $mediassigned, 'hidden' => false, 'vitalSigns' => $vitalSigns,
        ]);
    }

    public function absent($visitingId, $appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $appointment->status = "absent";
        $appointment->save();
        $today = Carbon::today();
        $today = $today->format('Y-m-d');
        $appointments = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->count();
        if ($appointments > 0) {
            return redirect('/todaysession/' . $visitingId . '/' . $appointments->id);
        } else {
            $userid = Auth::user()->id;
            return redirect('/todaysession/' . $userid)->with('alert', 'Appointments for this session are finished!');
        }
    }

    public function finish($visitingId, $appointmentId)
    {
        $prescriptionId = Prescription::where('appo_id', $appointmentId)->first();
        $pres_medi = Prescription_Medicine::where('prescription_id', $prescriptionId)->count();
        $mediCharges = 0;
        if ($pres_medi > 0) {
            $pres_medi = Prescription_Medicine::where('prescription_id', $prescriptionId)->get();
            foreach ($pres_medi as $pm) {
                $unit_price =  $pm->MedicinePrice();
                $quantity = $pm->quantity;
                $mediCharges += $unit_price * $quantity;
            }
        }

        $discount = 0; //change this if need
        $otherCharge = $mediCharges * 0.1;

        $bill = Bill::where('appo_id', $appointmentId)->first();
        $bill->medicine_charges = $mediCharges;
        $bill->other_charges = $otherCharge;
        $bill->discount = $discount;
        $bill->total = $mediCharges + $otherCharge;
        $bill->save();

        $appointment = Appointment::find($appointmentId);
        $appointment->status = 'finished';
        $appointment->save();

        $today = Carbon::today();
        $today = $today->format('Y-m-d');
        $appointments = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->count();
        if($appointments > 0){
            $appointments = Appointment::where('visiting_id', $visitingId)->where('date', $today)->where('status', 'pending')->orderBy('appo_number', 'asc')->first();
            return redirect('/todaysession/' . $visitingId . '/' . $appointments->id.'/finish');
        }
        else{
            return redirect('/todaysession/' . Auth::user()->id)->with('alert', 'All Appointments are Finished. Have a Nice Day!');
        }
        
    }
}
