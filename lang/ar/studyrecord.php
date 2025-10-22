<?php

return [
    'navigation' => [
        'label' => 'دفتر النصوص',
        'group' => 'إدارة الأكاديمية',
    ],
    'fields' => [
        'teacher_id' => 'معرّف الأستاذ',
        'time' => 'الوقت',
        'activity' => 'النشاط',
        'field' => 'المجال',
        'subject' => 'المادة',
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
    ],

    'mainTitle' => 'دفتر النصوص',
];
