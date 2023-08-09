<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'fname',
        'lname',
        'gender',
        'position',
        'regNum',
        'dob',
        'contact',
        'user_id',
    ];

    public function User() {
        return $this->belongsTo(User::class);
    }

    public function Staff()
    {
        return $this->hasOne(Staff::class);
    }
}
