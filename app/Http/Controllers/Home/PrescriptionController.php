<?php

namespace App\Http\Controllers\Home;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Prescription_Medicine;
use App\Models\RandomKey;
use App\Models\Bill;
use Carbon\Carbon;

class PrescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function prescription($patientId, $appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $patient = Patient::where('patient_id', $patientId)->first();
        if ($appointment->status == 'Absent') {
            return redirect()->back()->with('Error', 'You were Absent on that Appointment! No Prescription Available');
        } else {
            $prescription = Prescription::where('appo_id', $appointmentId)->first();
            $pres_medi = Prescription_Medicine::where('prescription_id', $prescription->id)->count();
            if ($pres_medi > 0) {
                $pres_medi = Prescription_Medicine::where('prescription_id', $prescription->id)->get();
            } else {
                $pres_medi = null;
            }

            $data = ['appointment' => $appointment, 'patient' => $patient];

            $pdf = app('dompdf.wrapper');
            $pdf->loadView('patient.prescription', $data);


            return $pdf->download($patient->fname . '_Appo' . $appointment->id . '_prescription.pdf');
        }
    }

    public function medical($patientId, $appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $patient = Patient::where('patient_id', $patientId)->first();

        if ($appointment->status == 'Absent') {
            return redirect()->back()->with('Error', 'You were Absent on that Appointment! No Prescription Available');
        } else if ($appointment->Visiting->type == 'TeleMedicine') {
            return redirect()->back()->with('alert', 'Sorry, We do not provide Medical Certification for TeleMedicine Appointment Type.');
        } else {
            $diagnosis = Diagnosis::where('appo_id', $appointmentId)->first();

            function generateKey()
            {
                return  Str::random(8);
            }

            $count = RandomKey::where('appo_id', $appointmentId)->count();
            if ($count == 0) {
                $same = true;
                while ($same) {
                    $randomKey = generateKey();
                    $keycount = RandomKey::where('key', $randomKey)->count();
                    if ($keycount > 0) {
                        $same = true;
                    } else {
                        $key = new RandomKey();
                        $key->key = $randomKey;
                        $key->appo_id = $appointmentId;
                        $key->save();
                        $same = false;
                    }
                }
            } else {
                $result = RandomKey::where('appo_id', $appointmentId)->first();
                $randomKey = $result->key;
            }

            $gendernew = '';
            $gender = '';

            if ($patient->gender == 'male') {
                $gender = 'he';
                $gendernew = 'him';
            } else {
                $gender = 'she';
                $gendernew = 'her';
            }

            $today = Carbon::now();
            $today = $today->format('Y-m-d');

            $data = ['appointment' => $appointment, 'patient' => $patient, 'key' => $randomKey, 'diagnosis' => $diagnosis, 'gender' => $gender, 'gendernew' => $gendernew, 'today' => $today];

            $pdf = app('dompdf.wrapper');
            $pdf->loadView('patient.medical', $data);

            return $pdf->download($patient->fname . '_Appo' . $appointment->id . '_medical_Certification.pdf');
        }
    }

    public function bill($patientId, $appointmentId)
    {
        $appointment = Appointment::find($appointmentId);
        $patient = Patient::where('patient_id', $patientId)->first();
        $diagnosis = Diagnosis::where('appo_id', $appointmentId)->first();
        if ($appointment->status == 'Absent') {
            return redirect()->back()->with('Error', 'You were Absent on that Appointment! No Prescription Available');
        } else if ($appointment->Visiting->type == 'TeleMedicine') {
            return redirect()->back()->with('alert', 'Sorry, We do not provide Medical Certification for TeleMedicine Appointment Type.');
        } else {
            $prescription = Prescription::where('appo_id', $appointmentId)->first();
            $pres_medi = Prescription_Medicine::where('prescription_id', $prescription->id)->count();
            if ($pres_medi > 0) {
                $pres_medi = Prescription_Medicine::where('prescription_id', $prescription->id)->get();
            } else {
                $pres_medi = null;
            }

            $bill = Bill::where('appo_id', $appointmentId)->first();
            if($bill->discount != null){
                $total = $bill->total - ($bill->discount*$bill->total/100);
            }
            $data = ['appointment' => $appointment, 'patient' => $patient, 'diagnosis' => $diagnosis, 'bill'=> $bill, 'total'=>$total];
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('patient.bill', $data);

            return $pdf->download($patient->fname . '_Appo' . $appointment->id . '_bill.pdf');
        }
    }
}
