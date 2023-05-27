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
        'regNum',
        'specialization',
        'echanneling_rate',
        'normal_rate',
        'user_id',
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }
}
