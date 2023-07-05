<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitings extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id','day','room_id','session','type','max_per_session',
    ];
    
    public function Doctor() {
        return $this->belongsTo(Doctor::class);
    }

    public function Room() {
        return $this->belongsTo(Room::class);
    }
}
