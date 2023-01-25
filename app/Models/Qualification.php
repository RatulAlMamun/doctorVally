<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
    protected $fillable = ['degree_id', 'institution_id', 'major', 'from_date', 'to_date', 'doctor_id'];

    public function doctor ()
    {
        return $this->belongsTo(Doctor::class);
    }



}
