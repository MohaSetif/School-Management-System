<?php

return [
    'mainTitle' => 'My Profile',
    'label' => 'My Personal Profile',
    'form' => [
        'full_name' => 'Full Name',
        'email' => 'Email',
    ],

    'status' => 'Status',
    'active' => 'Active',

    'roles' => [
        'teacher' => 'Teacher',
        'student' => 'Student',
        'headmaster' => 'Headmaster',
        'employee' => 'Employee',
        'default' => 'User',
    ],

    'teacher' => [
        'title' => 'Taught Subjects',
        'save_button' => 'Save',
        'subjects' => 'Subjects',
    ],

    'student' => [
        'title' => 'Student Information',
        'class' => 'Class',
        'roll_number' => 'Roll Number',
        'not_assigned' => 'Not Assigned',
    ],

    'default' => [
        'no_info' => 'No additional information available.',
    ],

    'errors' => [
        'teacher_only' => 'Only teachers can edit subjects.',
    ],

    'notifications' => [
        'success' => [
            'title' => 'Success!',
            'body' => 'Your subjects have been updated.',
        ],
        'error' => [
            'title' => 'Error',
            'body' => 'Failed to update subjects: :message',
        ],
    ],

    'subjects' => [
        'Mathematics' => 'Mathematics',
        'Natural Science' => 'Science',
        'English' => 'English Language',
        'French' => 'French Language',
        'Arabic' => 'Arabic Language',
        'Islamic Studies' => 'Islamic Studies',
        'History' => 'History',
        'Geography' => 'Geography',
        'Physics' => 'Physics',
        'Computer Science' => 'Computer Science',
        'Art' => 'Art',
        'Music' => 'Music',
        'Physical Education' => 'Physical Education',
    ],

    'purpose' => 'Select the subjects you currently teach.'
];
