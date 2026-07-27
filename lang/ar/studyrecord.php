<?php

return [
    'mainTitle' => 'دفتر النصوص',
    'navigation' => [
        'label' => 'دفتر النصوص',
        'group' => 'إدارة الأكاديمية',
    ],

    'fields' => [
        'teacher_id' => 'الأستاذ',
        'time' => 'الوقت',
        'activity' => 'النشاط',
        'field' => 'المجال',
        'subject' => 'المادة',
        'subject_id' => 'المادة',
        'grade_level' => 'القسم',
        'goal' => 'الهدف',
        'status' => 'الحالة',
        'statuses' => [
            'pending' => 'قيد الانتظار',
            'seen' => 'تمت المراجعة',
        ],
        'remarks' => 'ملاحظات',
        'created_at' => 'تاريخ الإنشاء',
        'updated_at' => 'تاريخ التحديث',
    ],

    'actions' => [
        'view' => 'عرض',
        'edit' => 'تعديل',
        'delete' => 'حذف',
        'download' => 'تحميل الملف',
        'view_report' => 'عرض التقرير',
    ],

    'placeholders' => [
        'no_goal' => 'لا يوجد هدف محدد',
        'no_remarks' => 'لا توجد ملاحظات',
    ],
];
