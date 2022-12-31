<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'created_by', 'status'];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }
}
