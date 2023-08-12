<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempMedicine extends Model
{
    use HasFactory;
    protected $fillable = ['medi_id', 'dose', 'quantity', 'perscription_id'];

    public function Medicine() {
        return $this->belongsTo(Medicine::class);
    }
}
