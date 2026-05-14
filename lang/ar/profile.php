<?php

return [
    'mainTitle' => 'حسابي',
    'label' => 'حسابي الخاص',
    'form' => [
        'full_name' => 'الاسم الكامل',
        'email' => 'البريد الإلكتروني',
    ],

    'status' => 'الحالة',
    'active' => 'نشط',

    'roles' => [
        'teacher' => 'أستاذ',
        'student' => 'تلميذ',
        'headmaster' => 'مدير',
        'employee' => 'موظف',
        'default' => 'مستخدم',
    ],

    'teacher' => [
        'title' => 'المواد التي تُدرّس',
        'save_button' => 'حفظ',
        'subjects' => 'المواد',
    ],

    'student' => [
        'title' => 'معلومات التلميذ',
        'class' => 'القسم',
        'roll_number' => 'رقم التسجيل',
        'not_assigned' => 'غير محدد',
    ],

    'default' => [
        'no_info' => 'لا توجد معلومات إضافية متاحة.',
    ],

    'errors' => [
        'teacher_only' => 'فقط الأساتذة يمكنهم تعديل المواد.',
    ],

    'notifications' => [
        'success' => [
            'title' => 'تم بنجاح!',
            'body' => 'تم تحديث المواد الخاصة بك.',
        ],
        'error' => [
            'title' => 'خطأ',
            'body' => 'فشل في تحديث المواد: :message',
        ],
    ],

    'subjects' => [
        'Mathematics' => 'الرياضيات',
        'Science' => 'العلوم',
        'English' => 'اللغة الإنجليزية',
        'Arabic' => 'اللغة العربية',
        'Islamic Studies' => 'العلوم الإسلامية',
        'History' => 'التاريخ',
        'Geography' => 'الجغرافيا',
        'Physics' => 'الفيزياء',
        'Chemistry' => 'الكيمياء',
        'Biology' => 'علم الأحياء',
        'Computer_science' => 'علوم الحاسب',
        'Art' => 'الفن',
        'Music' => 'الموسيقى',
        'Physical_education' => 'التربية البدنية',
    ],

    'purpose' => 'اختر المواد التي تُدرّس حاليًا.'
];
