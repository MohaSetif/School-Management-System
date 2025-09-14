<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'student_id',
        'date_of_birth',
        'address',
        'parent_name',
        'parent_phone',
        'group_id',
        'is_active',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active' => 'boolean',
    ];

    public function attendanceRecords()
    {
        return $this->hasMany(Attendance_record::class);
    }

    public function absenceNotifications()
    {
        return $this->hasMany(AbsenceNotification::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
