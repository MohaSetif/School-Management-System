<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance_record extends Model
{
    protected $fillable = [
        'student_id',
        'group_id',
        'marked_by',
        'attendance_date',
        'status',
        'notes',
        'consecutive_days',
        'start_date',
        'end_date',
        'notified',
        'notified_at',
        'notified_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'notified' => 'boolean',
        'notified_at' => 'datetime',
        'attendance_date' => 'date',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function markedBy()
    {
        return $this->belongsTo(User::class, 'marked_by');
    }

    protected static function booted()
    {
        static::creating(function ($record) {
            if (empty($record->group_id)) {
                $student = Student::find($record->student_id);
                $record->group_id = $student?->group_id;
            }
        });
    }
}
