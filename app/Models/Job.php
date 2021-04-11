<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\Company;
use App\Models\User;

class Job extends Model
{
    protected $fillable = [
        'title',
        'description',
        'experience',
        'salary',
        'company_id',
        'status',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'applications')->withPivot('status')->withTimestamps();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function images()
    {
        return $this->hasManyThrough(Image::class, Company::class, 'id', 'imageable_id', 'company_id', 'id');
    }
}
