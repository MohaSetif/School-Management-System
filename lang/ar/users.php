<?php

return [
    'navigation' => [
        'label' => 'المستخدمون',
        'group' => 'إدارة المستخدمين',
    ],
    'fields' => [
        'name' => 'الاسم',
        'email' => 'البريد الإلكتروني',
        'phone' => 'الهاتف',
        'role' => 'الدور',
        'password' => 'كلمة المرور',
        'is_active' => 'نشط',
        'created_at' => 'تاريخ الإنشاء',
    ],
    'roles' => [
        'teacher' => 'معلم',
        'employee' => 'موظف',
        'headmaster' => 'مدير المدرسة',
    ],
    'pages' => [
        'list' => 'قائمة المستخدمين',
        'create' => 'إضافة مستخدم',
        'edit' => 'تعديل المستخدم',
        'view' => 'عرض المستخدم',
    ],
];
