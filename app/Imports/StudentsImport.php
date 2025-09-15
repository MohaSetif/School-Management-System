<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate; // 👈 import this class

// Disable automatic heading formatting globally
HeadingRowFormatter::default('none');

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Convert Excel serial date to Carbon if it's numeric
        $dateOfBirth = null;
        if (!empty($row['تاريخ الازدياد'])) {
            if (is_numeric($row['تاريخ الازدياد'])) {
                $dateOfBirth = Carbon::instance(ExcelDate::excelToDateTimeObject($row['تاريخ الازدياد']));
            } else {
                $dateOfBirth = Carbon::parse($row['تاريخ الازدياد']);
            }
        }

        $enrollmentDate = null;
        if (!empty($row['تاريخ التسجيل'])) {
            if (is_numeric($row['تاريخ التسجيل'])) {
                $enrollmentDate = Carbon::instance(ExcelDate::excelToDateTimeObject($row['تاريخ التسجيل']));
            } else {
                $enrollmentDate = Carbon::parse($row['تاريخ التسجيل']);
            }
        }

        return new Student([
            'student_identifier'      => $row['رقم التعريف'],
            'last_name'               => $row['اللقب'],
            'first_name'              => $row['الاسم'],
            'gender'                  => $row['الجنس'] === 'ذكر' ? 'male' : 'female',
            'date_of_birth'           => $dateOfBirth,

            'is_judicial_birth'       => !empty($row['مولود بحكم']),
            'has_birth_certificate'   => $row['عقد الميلاد'] ?? 'normal',
            'birth_registration_year' => $row['سنة التسجيل في سجل الولادات'] ?? null,
            'birth_certificate_number'=> $row['رقم عقد الميلاد'] ?? null,
            'place_of_birth'          => $row['مكان الازدياد'] ?? null,

            'academic_year'           => $row['السنة'] ?? null,
            'group_id'                => $row['القسم'] ?? null,
            'schooling_system'        => $row['نظام التمدرس'] ?? null,
            'enrollment_number'       => $row['رقم القيد'] ?? null,
            'enrollment_date'         => $enrollmentDate,

            'is_orphan'               => !empty($row['اليتم']),
            'is_needy'                => !empty($row['معوز']),
            'health_status'           => $row['الحالة الصحية'] ?? null,
            'psychological_status'    => $row['الحالة النفسية'] ?? null,
            'is_sector_child'         => !empty($row['أبناء القطاع']),

            'is_active'               => true,
        ]);
    }
}
