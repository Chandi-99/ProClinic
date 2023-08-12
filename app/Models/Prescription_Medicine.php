<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription_Medicine extends Model
{
    use HasFactory;
    protected $fillable= [
        'prescription_id',
        'medicine_id',
        'quantity',
        'dose'
    ];

    public function Medicine(){
        return $this->belongsTo(Medicine::class);
    }

    public function Prescription(){
        return $this->belongsTo(Prescription::class);
    }
}
