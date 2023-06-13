<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse_Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'nurse_id',
        'room_id',
        'date',
        'session',
    ];

    public function Nurse() {
        return $this->belongsTo(Nurse::class);
    }

    public function Room() {
        return $this->belongsTo(Room::class);
    }
}
