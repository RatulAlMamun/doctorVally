<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'thumbnail', 'description', 'user_id', 'publish'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'publish' => 'boolean',
    ];

    /**
     * Get the thumbnail as url.
     *
     * @param  string  $value
     * @return string
     */
    public function getThumbnailAttribute($value)
    {
        return asset('uploads/blogs/'.$value);
    }
}
