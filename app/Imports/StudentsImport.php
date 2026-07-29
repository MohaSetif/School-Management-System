<?php

namespace App\Imports;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

HeadingRowFormatter::default('none');

class StudentsImport implements ToModel, WithHeadingRow
{
    private array $groups = [];

    public function __construct()
    {
        // Cache all groups once (IMPORTANT performance fix)
        $this->groups = Group::all()->keyBy(function ($g) {
            return $g->code . '_' . $g->name;
        })->toArray();
    }

    public function model(array $row)
    {
        // -----------------------------
        // 1. Validate required fields
        // -----------------------------
        $identifier = trim($row['رقم التعريف'] ?? '');

        if (!$identifier) {
            Log::warning('Skipped row: missing student_identifier', $row);
            return null;
        }

        // -----------------------------
        // 2. Parse dates safely
        // -----------------------------
        $dateOfBirth = $this->parseDate($row['تاريخ الازدياد'] ?? null);
        $enrollmentDate = $this->parseDate($row['تاريخ التسجيل'] ?? null);

        // -----------------------------
        // 3. Resolve group (FAST lookup)
        // -----------------------------
        $groupId = null;

        $code = $row['القسم'] ?? null;
        $name = $row['السنة'] ?? null;

        if ($code && $name) {
            $key = $code . '_' . $name;

            if (isset($this->groups[$key])) {
                $groupId = $this->groups[$key]['id'];
            } else {
                Log::warning("Group not found: {$key}");
            }
        }

        // -----------------------------
        // 4. Create student
        // -----------------------------
        return new Student([
            'student_identifier' => $identifier,
            'last_name' => $row['اللقب'] ?? null,
            'first_name' => $row['الاسم'] ?? null,

            'gender' => $this->normalizeGender($row['الجنس'] ?? null),
            'date_of_birth' => $dateOfBirth,

            'is_judicial_birth' => !empty($row['مولود بحكم']),
            'has_birth_certificate' => $row['عقد الميلاد'] ?? 'normal',

            'birth_registration_year' => $row['سنة التسجيل في سجل الولادات'] ?? null,
            'birth_certificate_number' => $row['رقم عقد الميلاد'] ?? null,
            'place_of_birth' => $row['مكان الازدياد'] ?? null,

            'academic_year' => $this->normalizeAcademicYear($name),
            'group_id' => $groupId,

            'schooling_system' => $row['نظام التمدرس'] ?? null,
            'enrollment_number' => $row['رقم القيد'] ?? null,
            'enrollment_date' => $enrollmentDate,

            'is_orphan' => !empty($row['اليتم']),
            'is_needy' => !empty($row['معوز']),
            'health_status' => $row['الحالة الصحية'] ?? null,
            'psychological_status' => $row['الحالة النفسية'] ?? null,
            'is_sector_child' => !empty($row['أبناء القطاع']),

            'is_active' => true,
        ]);
    }

    // -----------------------------
    // Helpers
    // -----------------------------

    private function parseDate($value): ?Carbon
    {
        if (empty($value))
            return null;

        try {
            if (is_numeric($value)) {
                return Carbon::instance(ExcelDate::excelToDateTimeObject($value));
            }

            return Carbon::parse($value);
        } catch (\Exception $e) {
            Log::warning("Invalid date format", ['value' => $value]);
            return null;
        }
    }

    private function normalizeGender($value): string
    {
        return match (trim($value)) {
            'ذكر' => 'male',
            'أنثى' => 'female',
            default => 'unknown',
        };
    }

    public function headingRow(): int
    {
        return 7;
    }

    private function normalizeAcademicYear(?string $value): ?string
    {
        return match (trim($value ?? '')) {
            'السنة الأولى', '1st year', 'First year', 'first year', 'أولى' => 'first_year',
            'السنة الثانية', '2nd year', 'Second year', 'second year', 'ثانية' => 'second_year',
            'السنة الثالثة', '3rd year', 'Third year', 'third year', 'ثالثة' => 'third_year',
            'السنة الرابعة', '4th year', 'Fourth year', 'fourth year', 'رابعة' => 'fourth_year',
            'السنة الخامسة', '5th year', 'Fifth year', 'fifth year', 'خامسة' => 'fifth_year',
            default => null,
        };
    }
}