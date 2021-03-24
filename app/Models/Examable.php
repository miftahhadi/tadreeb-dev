<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphPivot;

class Examable extends MorphPivot
{   
    protected $table = 'examables';

    protected $dates = [
        'tampil_otomatis',
        'buka_otomatis',
        'batas_buka',
        
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'classroomexam_user', 'classroom_exam_id', 'user_id')
                    ->using(ClassExamUser::class)
                    ->withPivot([
                        'attempt', 
                        'answers',
                        'waktu_mulai', 
                        'waktu_selesai'
                    ]);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

}