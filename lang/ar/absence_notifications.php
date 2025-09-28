<?php

return [
    'fields' => [
        'student' => 'الطالب',
        'start_date' => 'تاريخ البداية',
        'end_date' => 'تاريخ النهاية',
        'consecutive_days' => 'أيام الغياب المتتالية',
        'notified' => 'تم الإخطار',
        'created_at' => 'تاريخ الإخطار',
    ],
    'hints' => [
        'consecutive_days' => 'عدد الأيام التي تغيب فيها الطالب على التوالي',
        'notified' => 'يشير إلى ما إذا كان ولي الأمر قد تم إخباره بالغياب',
    ],
    'actions' => [
        'view' => 'عرض',
        'edit' => 'تعديل',
        'delete' => 'حذف',
    ],
    'filters' => [
        'recent' => 'الأحدث (آخر 7 أيام)',
    ],
    'navigation' => [
        'label' => 'إشعارات الغياب',
        'group' => 'إدارة الغياب',
    ],

];
