<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'medi_name',
        'company',
        'availability',
        'after_Eat',
        'unit_Price',
        'uses',
        'side_effects',
        'mg',
    ];
}
