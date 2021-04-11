<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Image;
use App\Models\Job;
use App\Models\User;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'website',
        'introduce',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
