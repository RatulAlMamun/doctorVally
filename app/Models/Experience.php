<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = ['organization', 'designation', 'from_date', 'to_date', 'current_working', 'location', 'doctor_id', 'created_by'];

    public function doctor ()
    {
        return $this->belongsTo(Doctor::class);
    }
}
