<?php

return [
    'mainTitle' => 'Students with Frequent Absences',
    'fields' => [
        'student' => 'Student',
        'start_date' => 'Start Date',
        'end_date' => 'End Date',
        'consecutive_days' => 'Consecutive Absence Days',
        'notified' => 'Notified',
        'created_at' => 'Notification Date',
    ],
    'hints' => [
        'consecutive_days' => 'Number of days the student has been absent consecutively',
        'notified' => 'Indicates whether the parent has been notified of the absence',
    ],
    'filters' => [
        'recent' => 'Recent (last 7 days)',
    ],
    'navigation' => [
        'label' => 'Absence Notifications',
        'group' => 'Absence Management',
    ],

];
