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

    'placeholders' => [
        'no_goal' => 'لا يوجد هدف محدد',
        'no_remarks' => 'لا توجد ملاحظات',
    ],
];
