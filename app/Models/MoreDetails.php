<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoreDetails extends Model
{
    use HasFactory;
    protected $fillable = ['patient_id', 'civil_status', 'occupation', 'weight', 'height', 'blood_group', 'smoking', 'date'];
}
