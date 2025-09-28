<?php

return [
    'navigation' => [
        'label' => 'غيابات الأعضاء',
        'group' => 'أعضاء المؤسسة'
    ],
    'form' => [
        'tabs' => [
            'main' => 'الغياب',
            'additional' => 'إضافي',
        ],
        'sections' => [
            'main' => 'تفاصيل الغياب',
            'additional' => 'معلومات إضافية',
            'audit' => 'تدقيق',
            'details' => 'تفاصيل',
        ],
        'fields' => [
            'member' => 'العضو الأكاديمي',
            'absence_date' => 'تاريخ الغياب',
            'reason' => 'السبب',
            'notes' => 'ملاحظات',
            'status' => 'الحالة',
            'reason' => 'السبب',
            'created_at' => 'تاريخ الإنشاء',
            'updated_at' => 'تاريخ التحديث',
        ],
        'status' => [
            'present' => 'حاضر',
            'absent' => 'غائب',
            'late' => 'متأخر',
            'excused' => 'معذور',
        ]
    ],
    'table' => [
        'columns' => [
            'member' => 'العضو الأكاديمي',
            'absence_date' => 'تاريخ الغياب',
            'reason' => 'السبب',
            'created_at' => 'تاريخ الإنشاء',
        ],
        'filters' => [
            //
        ],
        'actions' => [
            'view' => 'عرض',
            'edit' => 'تعديل',
            'delete' => 'حذف',
        ],
        'bulk_actions' => [
            'delete_selected' => 'حذف المحدد',
        ],
    ],
    'messages' => [
        'created_successfully' => 'تم إنشاء الغياب بنجاح.',
        'updated_successfully' => 'تم تحديث الغياب بنجاح.',
        'deleted_successfully' => 'تم حذف الغياب بنجاح.',
        'deleted_selected_successfully' => 'تم حذف الغيابات المحددة بنجاح.',
    ],
];