<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allergy extends Model
{
    use HasFactory;
    protected $fillable = ['allergie','patient_id', 'status'];

    public function Patient() {
        return $this->belongsTo(Patient::class);
    }
}

