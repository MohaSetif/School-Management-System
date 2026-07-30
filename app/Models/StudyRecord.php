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
        'remarks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}