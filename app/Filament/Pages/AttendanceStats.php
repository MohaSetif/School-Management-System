<?php

namespace App\Filament\Pages;

use App\Models\Student;
use App\Models\Setting;
use App\Models\Attendance;
use App\Models\Attendance_record;
use App\Models\SchoolSettings;
use BackedEnum;
use Filament\Pages\Page;
use Illuminate\Support\Facades\DB;

class AttendanceStats extends Page
{
    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'إحصائيات الحضور';
    protected static ?string $title = 'إحصائيات الحضور والغياب';

    protected string $view = 'filament.pages.attendance-stats';

    public array $stats = [];

    public function mount()
    {
        $this->loadStats();
    }

    protected function loadStats(): void
    {
        $totalDays = SchoolSettings::first()?->working_days ?? 0;

        $totalStudents = Student::count();

        $totalAttendances = $totalDays * $totalStudents;
        $totalabsences = Attendance_record::where('status', 'absent')->count();
        $realisticAttendance = $totalAttendances - $totalabsences; // reuse variable — avoids duplicate query

        $attendancePercent = $totalDays > 0
            ? round(($realisticAttendance * 100) / $totalAttendances, 2)
            : 0;

        $realisticPercent = $totalDays > 0
            ? round(($totalabsences * 100) / $totalAttendances, 2)
            : 0;

        $absencePercent = 100 - $attendancePercent;

        $this->stats = [
            'total_students' => $totalStudents,
            'total_days' => $totalDays,
            'total_attendances' => $totalAttendances,
            'realistic_attendance' => $realisticAttendance,
            'attendance_percent' => $attendancePercent,
            'realistic_percent' => $realisticPercent,
            'absence_percent' => $absencePercent,
        ];
    }
}
