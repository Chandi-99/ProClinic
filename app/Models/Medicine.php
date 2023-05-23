<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medi_name',
        'medi_Name',
        'company',
        'availability',
        'after_Eat',
        'unit_Price',
    ];
}
