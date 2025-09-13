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

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getConsecutiveAbsenceDays()
    {
        $today = Carbon::today();
        $consecutiveDays = 0;
        
        // Check backwards from today
        for ($i = 0; $i < 10; $i++) { // Check last 10 days max
            $checkDate = $today->copy()->subDays($i);
            
            // Skip weekends (assuming school days are Mon-Fri)
            if ($checkDate->isWeekend()) {
                continue;
            }
            
            $attendance = $this->attendanceRecords()
                ->where('attendance_date', $checkDate->format('Y-m-d'))
                ->first();
            
            if ($attendance && $attendance->status === 'absent') {
                $consecutiveDays++;
            } else {
                break; // Stop counting if present or no record
            }
        }
        
        return $consecutiveDays;
    }

    public function hasConsecutiveAbsences($days = 3)
    {
        return $this->getConsecutiveAbsenceDays() >= $days;
    }
}
