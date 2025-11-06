<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudyRecord extends Model
{
    protected $fillable = [
        'teacher_id',
        'time',
        'activity',
        'field',
        'subject_id',
        'grade_level',
        'goal',
        'status',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

}
