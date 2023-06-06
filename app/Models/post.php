<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'user_id', 'image_path'];

    public function author()
    {
        return $this->belongsTo('App\Models\User');
    }

}
