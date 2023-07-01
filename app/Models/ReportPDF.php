<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportPDF extends Model
{
    use HasFactory;

    protected $fillable = [
        'pdfreport_name',
        'date',
        'visibility',
        'path',
        'patient_id',
    ];

    public function Patient() {
        return $this->belongsTo(Patient::class);
    }
}
