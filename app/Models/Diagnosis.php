<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    use HasFactory;
    protected $fillable = [
        'chief_complain',
        'symptoms',
        'physical_examination',
        'recommended_tests',
        'identified_disease',
        'rest_no_days',
        'blood_pressure',
        'blood_sugar_level',
    ];

    public function Appointment(){
        return $this->belongsTo(Appointment::class);
    }
}
