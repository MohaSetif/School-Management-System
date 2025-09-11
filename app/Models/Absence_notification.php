<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absence_notification extends Model
{
    protected $fillable = [
        'student_id',
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
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function notifiedBy()
    {
        return $this->belongsTo(User::class, 'notified_by');
    }
}
