<?php

return [
    'mainTitle' => 'قائمة الحضور',
    'navigation' => [
        'label' => 'قائمة الحضور',
        'group' => 'إدارة الأكاديمية',
    ],

    'date' => 'التاريخ',
    'student' => 'الطالب',
    'group' => 'المجموعة',
    'status' => 'الحالة',
    'notes' => 'ملاحظات',
    'marked_by' => 'تم التعليم بواسطة',
    'attendance_date' => 'تاريخ الحضور',

    'statuses' => [
        'present' => 'حاضر',
        'absent'  => 'غائب',
        'late'    => 'متأخر',
        'excused' => 'مُعفى',
        'exit_before_time' => 'خروج قبل الوقت',
    ],

    'filters' => [
        'from'  => 'من',
        'until' => 'إلى',
    ],

    'common' => [
        'no_records' => 'لا توجد سجلات حضور',
        'create'     => 'تسجيل حضور جديد',
        'view'       => 'عرض سجل الحضور',
        'edit'       => 'تعديل',
        'delete'     => 'حذف',
        'deleted'    => 'تم حذف سجل الحضور بنجاح',
        'bulk_delete'=> 'حذف السجلات المحددة',
        'bulk_deleted'=> 'تم حذف سجلات الحضور المحددة بنجاح',
    ],

    'mark_attendance' => 'تسجيل الحضور',
    'select_group' => 'اختر المجموعة',
    'attendance_date' => 'تاريخ الحضور',
    'load_students' => 'تحميل الطلاب',
    'save_attendance' => 'حفظ الحضور',

    // New keys for the Blade page
    'load_students_heading' => 'تحميل الطلاب',
    'load_students_instructions' => 'اختر المجموعة والتاريخ، ثم اضغط على "تحميل الطلاب".',
    'mark_attendance_for_date' => 'تسجيل الحضور — :date',
    'group_label' => 'المجموعة: :group',
    'students_count' => 'عدد الطلاب: :count',
    'student_id' => 'رقم الطالب: :id',
    'notes_placeholder' => 'ملاحظات (اختياري)',
    'status_present' => 'حاضر',
    'status_absent'  => 'غائب',
    'status_late'    => 'متأخر',
    'status_excused' => 'مُعفى',
    'status_exit_before_time' => 'خروج قبل الوقت',

    'notifications' => [
        'error_select_group_date' => 'خطأ',
        'error_select_group_date_save' => 'الرجاء اختيار مجموعة وتاريخ وتحميل الطلاب أولاً قبل الحفظ.',
        'success_saved' => 'تم حفظ الحضور لـ :count طالب.',
        'consecutive_absences_title' => 'تم اكتشاف غيابات متتالية',
        'consecutive_absences_body' => 'الطالب رقم :student غاب لمدة :count أيام متتالية (من :start إلى :end).',
    ],
];
