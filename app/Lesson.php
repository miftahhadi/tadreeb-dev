<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class);
    }
}
