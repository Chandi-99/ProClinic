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
}
