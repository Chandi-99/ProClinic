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

    /*
    $patients = Patient::all();

    foreach ($patients as $patient) {
    $users = $patient->users; // Get all users associated with the patient
    */
}

