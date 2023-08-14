<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RandomKey extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'appo_id'];
}
