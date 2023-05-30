<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_name',
        'date',
        'visibility',
        'image_path',
        'patient_id',
    ];

    public function Patient() {
        return $this->belongsTo(Patient::class);
    }
}
