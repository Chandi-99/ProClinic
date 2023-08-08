<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'cv_name',
        'cv_email',
        'cv_position',
        'cv_aboutme',
        'cv_file_path',
        'status'
    ];
}
