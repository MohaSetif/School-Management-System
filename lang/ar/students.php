<?php

return [
    'mainTitle' => 'الطلاب',
    'fields' => [
        'student_identifier' => 'رقم التعريف',
        'last_name' => 'اللقب',
        'first_name' => 'الاسم',
        'full_name' => 'الاسم الكامل',
        'name' => 'الاسم الكامل',
        'genders' => [
            'male' => 'ذكر',
            'female' => 'أنثى'
        ],
        'group' => 'القسم',
        'group_id' => 'القسم',
        'gender' => 'الجنس',
        'date_of_birth' => 'تاريخ الازدياد',
        'place_of_birth' => 'مكان الازدياد',
        'academic_year' => 'السنة',
        'schooling_system' => 'نظام التمدرس',
        'enrollment_number' => 'رقم القيد',
        'enrollment_date' => 'تاريخ التسجيل',
        'is_active' => 'نشط',
        'is_judicial_birth' => 'مولود بحكم',
        'has_birth_certificate' => 'عقد الميلاد',
        'birth_registration_year' => 'سنة التسجيل في سجل الولادات',
        'birth_certificate_number' => 'رقم عقد الميلاد',
        'is_orphan' => 'يتيم',
        'not_orphan' => 'غير يتيم',
        'is_needy' => 'معوز',
        'not_needy' => 'غير معوز',
        'health_status' => 'الحالة الصحية',
        'psychological_status' => 'الحالة النفسية',
        'is_sector_child' => 'ابن قطاع',
    ],

    'sections' => [
        'personal_info' => 'المعلومات الشخصية',
        'academic_info' => 'المعلومات الأكاديمية',
        'social_health' => 'الوضعية الاجتماعية والصحية',
        'birth_infor' => 'معلومات الولادة',
        'school_infor' => 'معلومات التمدرس',
        'social_infor' => 'الوضعية الاجتماعية',
        'health_infor' => 'الوضعية الصحية',
        'timestamps' => 'تاريخ الإضافة والتعديل',
    ],

    'filters' => [
        'group' => 'الفوج',
        'is_active' => 'حالة النشاط',
        'is_orphan' => 'يتيم',
        'is_needy' => 'محتاج',
    ],

    'actions' => [
        'edit' => 'تعديل',
        'delete' => 'حذف',
        'delete_selected' => 'حذف المحددين',
        'import' => 'رفع ملف الطلاب',
    ],

    'import' => [
        'file' => 'ملف Excel',
        'helper' => 'قم برفع ملف إكسل (.xlsx أو .xls) يحتوي على بيانات الطلاب',
    ],

    'notifications' => [
        'import_success' => 'تم استيراد الطلاب بنجاح!',
        'import_failed' => 'فشل الاستيراد',
        'import_failed_with_errors' => 'فشل الاستيراد مع أخطاء في التحقق:',
        'row_error' => 'السطر :row: :errors',
        'import_exception' => 'حدث خطأ أثناء الاستيراد: :message',
    ],

    'navigation' => [
        'label' => 'الطلاب',
        'group' => 'أعضاء المؤسسة',
        'label2' => 'إدارة الطلاب',
        'label3' => 'إحصائيات الطلاب',
    ],

    'stats' => 'إحصائيات تلاميذ المدرسة',
    'academic_years_stats' => 'إحصائيات سنوات التمدرس',
    'orphans_stats' => 'إحصائيات الأيتام',
    'needy_stats' => 'إحصائيات المعوزين',
    'first_year' => 'السنة الأولى',
    'second_year' => 'السنة الثانية',
    'third_year' => 'السنة الثالثة',
    'fourth_year' => 'السنة الرابعة',
    'fifth_year' => 'السنة الخامسة',
    'all_years' => 'جميع السنوات',

    'groups' => [
        '1st year' => 'السنة الأولى',
        '2nd year' => 'السنة الثانية',
        '3rd year' => 'السنة الثالثة',
        '4th year' => 'السنة الرابعة',
        '5th year' => 'السنة الخامسة',
    ],

    'pages' => [
        'list' => 'قائمة الطلاب',
        'create' => 'إضافة طالب',
        'edit' => 'تعديل طالب',
        'view' => 'عرض طالب',
    ],
];
