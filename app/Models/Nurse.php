<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
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
    ];

    public function NurseRooms() {
        return $this->hasMany(Nurse_Room::class);
    }
}
