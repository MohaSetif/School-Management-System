<?php

return [
    'mainTitle' => 'Students',
    'fields' => [
        'student_identifier' => 'Identifier Number',
        'last_name' => 'Last Name',
        'first_name' => 'First Name',
        'full_name' => 'Full Name',
        'name' => 'Full Name',
        'genders' => [
            'male' => 'Male',
            'female' => 'Female'
        ],
        'group' => 'Class',
        'group_id' => 'Class',
        'gender' => 'Gender',
        'date_of_birth' => 'Date of Birth',
        'place_of_birth' => 'Place of Birth',
        'academic_year' => 'Year',
        'schooling_system' => 'Schooling System',
        'enrollment_number' => 'Enrollment Number',
        'enrollment_date' => 'Enrollment Date',
        'is_active' => 'Active',
        'is_judicial_birth' => 'Judicial Birth',
        'has_birth_certificate' => 'Birth Certificate',
        'birth_registration_year' => 'Birth Registration Year',
        'birth_certificate_number' => 'Birth Certificate Number',
        'is_orphan' => 'Orphan',
        'not_orphan' => 'Not Orphan',
        'is_needy' => 'Needy',
        'not_needy' => 'Not Needy',
        'health_status' => 'Health Status',
        'psychological_status' => 'Psychological Status',
        'is_sector_child' => 'Sector Child',
    ],

    'sections' => [
        'personal_info' => 'Personal Information',
        'academic_info' => 'Academic Information',
        'social_health' => 'Social & Health Status',
    ],

    'filters' => [
        'group' => 'Group',
        'is_active' => 'Activity Status',
        'is_orphan' => 'Orphan',
        'is_needy' => 'Needy',
    ],

    'actions' => [
        'edit' => 'Edit',
        'delete' => 'Delete',
        'delete_selected' => 'Delete Selected',
        'import' => 'Import Students File',
    ],

    'import' => [
        'file' => 'Excel File',
        'helper' => 'Upload an Excel file (.xlsx or .xls) containing students data',
    ],

    'notifications' => [
        'import_success' => 'Students imported successfully!',
        'import_failed' => 'Import failed',
        'import_failed_with_errors' => 'Import failed with validation errors:',
        'row_error' => 'Row :row: :errors',
        'import_exception' => 'Error occurred during import: :message',
    ],

    'navigation' => [
        'label' => 'Students',
        'group' => 'Institution Members',
        'label2' => 'Students Management',
        'label3' => 'Students Statistics',
    ],

    'stats' => 'School Students Statistics',
    'academic_years_stats' => 'Schooling Years Statistics',
    'orphans_stats' => 'Orphans Statistics',
    'needy_stats' => 'Needy Statistics',
    'first_year' => 'First Year',
    'second_year' => 'Second Year',
    'third_year' => 'Third Year',
    'fourth_year' => 'Fourth Year',
    'fifth_year' => 'Fifth Year',
    'all_years' => 'All Years',

    'groups' => [
        '1st year' => '1st Year',
        '2nd year' => '2nd Year',
        '3rd year' => '3rd Year',
        '4th year' => '4th Year',
        '5th year' => '5th Year',
    ],

    'pages' => [
        'list' => 'Students List',
        'create' => 'Create Student',
        'edit' => 'Edit Student',
        'view' => 'View Student',
    ],
];
