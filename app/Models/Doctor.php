<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'bmdc_no', 'gender', 'address', 'bio', 'image', 'treat_summary', 'facebook', 'youtube', 'linkedin', 'twitter', 'user_id'];

    public function specialities()
    {
        return $this->belongsToMany(Speciality::class);
    }

    public function experiences ()
    {
        return $this->hasMany(Experience::class);
    }

    public function qualifications ()
    {
        return $this->hasMany(Qualification::class);
    }
}
