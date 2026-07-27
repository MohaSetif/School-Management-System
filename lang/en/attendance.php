<?php

return [
    'mainTitle' => 'Attendance List',
    'navigation' => [
        'label' => 'Attendance List',
        'group' => 'Academy Management',
    ],

    'date' => 'Date',
    'student' => 'Student',
    'group' => 'Group',
    'status' => 'Status',
    'notes' => 'Notes',
    'marked_by' => 'Marked By',
    'attendance_date' => 'Attendance Date',

    'statuses' => [
        'present' => 'Present',
        'absent'  => 'Absent',
        'late'    => 'Late',
        'excused' => 'Excused',
        'exit_before_time' => 'Exit Before Time',
    ],

    'filters' => [
        'from'  => 'From',
        'until' => 'Until',
    ],

    'actions' => [
        'download_ticket' => 'Download Ticket',
    ],

    'common' => [
        'no_records' => 'No attendance records',
        'create'     => 'Create new attendance record',
        'view'       => 'View',
        'edit'       => 'Edit',
        'delete'     => 'Delete',
        'deleted'    => 'Attendance record deleted successfully',
        'bulk_delete'=> 'Delete selected records',
        'bulk_deleted'=> 'Selected attendance records deleted successfully',
    ],

    'mark_attendance' => 'Mark Attendance',
    'select_group' => 'Select Group',
    'attendance_date' => 'Attendance Date',
    'load_students' => 'Load Students',
    'save_attendance' => 'Save Attendance',

    // New keys for the Blade page
    'load_students_heading' => 'Load Students',
    'load_students_instructions' => 'Select group and date, then click "Load Students".',
    'mark_attendance_for_date' => 'Mark Attendance — :date',
    'group_label' => 'Group: :group',
    'students_count' => 'Students Count: :count',
    'student_id' => 'Student ID: :id',
    'notes_placeholder' => 'Notes (Optional)',
    'status_present' => 'Present',
    'status_absent'  => 'Absent',
    'status_late'    => 'Late',
    'status_excused' => 'Excused',
    'status_exit_before_time' => 'Exit Before Time',

    'notifications' => [
        'error_select_group_date' => 'Error',
        'error_select_group_date_save' => 'Please select a group and a date, and load students first before saving.',
        'success_saved' => 'Attendance saved for :count students.',
        'consecutive_absences_title' => 'Consecutive absences detected',
        'consecutive_absences_body' => 'Student #:student has been absent for :count consecutive days (from :start to :end).',
    ],

    'stats' => [
        'nav_label' => 'Attendance Stats',
        'title' => 'Attendance and Absence Statistics',
        'total_students' => 'Number of Students',
        'total_days' => 'Number of Working Days',
        'realistic_attendance' => 'Actual Attendance',
        'total_attendances' => 'Total Attendance',
        'attendance_percent' => 'Attendance Percentage',
        'absence_percent' => 'Absence Percentage',
        'last_update' => 'Last Update:',
    ],
];
