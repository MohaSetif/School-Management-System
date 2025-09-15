<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_identifier',       // رقم التعريف
        'last_name',                // اللقب
        'first_name',               // الاسم
        'gender',                   // الجنس
        'date_of_birth',            // تاريخ الازدياد
        'is_judicial_birth',        // مولود بحكم
        'has_birth_certificate',    // عقد الميلاد
        'birth_registration_year',  // سنة التسجيل في سجل الولادات
        'birth_certificate_number', // رقم عقد الميلاد
        'place_of_birth',           // مكان الازدياد
        'academic_year',            // السنة
        'group_id',                 // القسم
        'schooling_system',         // نظام التمدرس
        'enrollment_number',        // رقم القيد
        'enrollment_date',          // تاريخ التسجيل
        'is_orphan',                // اليتيم
        'is_needy',                 // معوز
        'health_status',            // الحالة الصحية
        'psychological_status',     // الحالة النفسية
        'is_sector_child',          // أبناء القطاع
        'is_active',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'birth_registration_year' => 'integer',
        'enrollment_date' => 'date',
        'is_judicial_birth' => 'boolean',
        'is_orphan' => 'boolean',
        'is_needy' => 'boolean',
        'is_sector_child' => 'boolean',
        'is_active' => 'boolean',
    ];

    // 🔗 Relationships
    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function attendanceRecords()
    {
        return $this->hasMany(Attendance_record::class);
    }

    public function absenceNotifications()
    {
        return $this->hasMany(AbsenceNotification::class);
    }

    // 🔧 Accessors
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
