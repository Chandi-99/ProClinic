<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
        'contact',
        'nic',
        'address',
        'gender',
        'dob',
        'user_id',
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Reports() {
        return $this->hasMany(Report::class);
    }

    public function PDFReports() {
        return $this->hasMany(ReportPDF::class);
    }

    public function Appointments() {
        return $this->hasMany(Appointment::class);
    }

    public function Allergies() {
        return $this->hasMany(Allergy::class);
    }
}

