<?php

return [
    'label' => 'التوزيع الأسبوعي',
    'weeklySchedule' => 'التوزيع الأسبوعي',
    'noClasses' => 'لا وجود لحصص',

    'form' => [
        'add_new' => 'إضافة حصة جديدة',
    ],

    'buttons' => [
        'save' => 'حفظ الجدول',
        'saving' => 'جارٍ الحفظ...',
    ],

    'weekly_schedule' => 'الجدول الأسبوعي',

    'filter' => [
        'all_classes' => 'كل الأقسام',
        'button' => 'تصفية',
    ],

    'fields' => [
        'dayofWeek' => 'اليوم',
        'startTime' => 'وقت البداية',
        'endTime' => 'وقت النهاية',
        'teacher' => 'المعلم',
        'class' => 'القسم',
        'subject' => 'المادة',
    ],

    'days' => [
        'monday' => 'الإثنين',
        'tuesday' => 'الثلاثاء',
        'wednesday' => 'الأربعاء',
        'thursday' => 'الخميس',
        'friday' => 'الجمعة',
        'saturday' => 'السبت',
        'sunday' => 'الأحد',
    ],

    'totalClasses' => 'مجموع الحصص',
    'teachers' => 'الأساتذة',
    'classes' => 'الأفواج',

    'notifications' => [
        'invalid_time' => [
            'title' => 'خطأ في التوقيت',
            'body' => 'يجب أن يكون وقت النهاية بعد وقت البداية.',
        ],
        'teacher_conflict' => [
            'title' => 'تعارض في الجدول',
            'body' => 'المعلم المحدد لديه حصة أخرى في هذا الوقت.',
        ],
        'group_conflict' => [
            'title' => 'تعارض في الجدول',
            'body' => 'هذا القسم لديه حصة أخرى في نفس الوقت.',
        ],
        'success' => [
            'title' => 'تم بنجاح!',
            'body' => 'تمت إضافة الحصة إلى الجدول بنجاح.',
        ],
    ],
];
