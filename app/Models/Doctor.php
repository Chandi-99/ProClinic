<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected  $fillable = [
        'fname',
        'lname',
        'gender',
        'dob',
        'regNum',
        'specialization',
        'echanneling_rate',
        'normal_rate',
        'contact',
        'user_id',
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Visitings() {
        return $this->hasMany(Visitings::class);
    }
}
