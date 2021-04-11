<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\User;

class Tag extends Model
{
    public function users()
    {
        return $this->morphedByMany(User::class, 'taggable');
    }

    public function jobs()
    {
        return $this->morphedByMany(Job::class, 'taggable');
    }
}
