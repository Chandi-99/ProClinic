<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable =[
        'appo_id',
        'medicine_charges',
        'doctor_charges',
        'other_charges',
        'discount',
        'total'
    ];
}
