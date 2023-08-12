<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'appo_id',
        'description',
    ];

    public function Appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function Prescription_Medicine(){
        return $this->hasMany(Prescription_Medicine::class);
    }

}
