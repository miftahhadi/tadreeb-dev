<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class)
                    ->withPivot('urutan')
                    ->orderBy('urutan', 'asc');
    }

    public function classrooms()
    {
        return $this->belongsToMany(Classroom::class)->using(ClassroomExam::class)
                                                    ->withPivot([
                                                        'id',
                                                        'tampil',
                                                        'buka',
                                                        'buka_hasil',
                                                        'tampil_otomatis',
                                                        'buka_otomatis',
                                                        'batas_buka',
                                                        'durasi',
                                                        'attempt'
                                                    ]);
    }

    public function sections()
    {
        return $this->morphToMany(Section::class, 'sectionable');
    }
}