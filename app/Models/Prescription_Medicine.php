<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription_Medicine extends Model
{
    use HasFactory;
    protected $fillable= [
        'prescription_id',
        'medi_id',
        'quantity',
        'dose'
    ];

    public function MedicineName(){
        $medi =  Medicine::where('id',$this->medi_id)->first();
        return $medi->medi_name;
    }

    public function MedicineMg(){
        $medi =  Medicine::where('id',$this->medi_id)->first();
        return $medi->mg;
    }

    public function MedicineAfter(){
        $medi =  Medicine::where('id',$this->medi_id)->first();
        return $medi->after_eat;
    }

    public function Prescription(){
        return $this->belongsTo(Prescription::class);
    }

    public function medi_Name(){
        $all = Prescription_Medicine::where('prescription_id', $this->prescription_id)->orderBy('created_at', 'desc')->first();
        $medicine = Medicine::find($all->medi_id);
        return $medicine->medi_name;
    }
}
