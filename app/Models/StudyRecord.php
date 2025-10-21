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
        'subject',
        'goal',
        'status',
    ];
}
