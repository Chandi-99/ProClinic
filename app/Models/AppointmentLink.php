<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentLink extends Model
{
    use HasFactory;
    protected $fillable  = [ 'link', 'date', 'visiting_id'];
}
