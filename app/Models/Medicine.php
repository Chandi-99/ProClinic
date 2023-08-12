<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use HasFactory;
    //use SoftDeletes;

    protected $fillable = [
        'medi_name',
        'company',
        'availability',
        'after_Eat',
        'unit_Price',
        'uses',
        'side_effects',
        'mg',
        'image',
        'precautions',
        'overdose',
        'howtouse',
    ];

    public function TempMedi() {
        return $this->belongsTo(TempMedi::class);
    }

    public function Prescription_Medicine(){
        return $this->hasMany(Prescription_Medicine::class);
    }
}
