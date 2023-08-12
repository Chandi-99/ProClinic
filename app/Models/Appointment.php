<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'visiting_id',
        'appo_number',
        'patient_id',
        'prescription_id',
        'bill_id',
        'start_time',
        'status',
        'date',
    ];

    public function Visiting(){
        return $this->belongsTo(Visitings::class);
    }

    public function Prescription(){
        return $this->belongsTo(Prescription::class);
    }

    public function Patient(){
        $patient = Patient::where('patient_id', $this->patient_id)->get();
        return $patient[0];
    }

    public function Diagnosis(){
        return $this->belongsTo(Diagnosis::class);
    }

    // public function MediName(){
    //     $temp = Prescription::where('appo_id', $this->id)->first();
    // }
}
