<?php

return [
    'label' => 'Weekly Schedule',
    'weeklySchedule' => 'Weekly Schedule',
    'noClasses' => 'No classes available',

    'form' => [
        'add_new' => 'Add new class',
    ],

    'buttons' => [
        'save' => 'Save Schedule',
        'saving' => 'Saving...',
    ],

    'weekly_schedule' => 'Weekly Schedule',

    'filter' => [
        'all_classes' => 'All Classes',
        'button' => 'Filter',
    ],

    'fields' => [
        'dayofWeek' => 'Day',
        'startTime' => 'Start Time',
        'endTime' => 'End Time',
        'teacher' => 'Teacher',
        'class' => 'Class',
        'subject' => 'Subject',
    ],

    'days' => [
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday',
    ],

    'totalClasses' => 'Total Classes',
    'teachers' => 'Teachers',
    'classes' => 'Classes',

    'notifications' => [
        'invalid_time' => [
            'title' => 'Invalid Time',
            'body' => 'End time must be after start time.',
        ],
        'teacher_conflict' => [
            'title' => 'Schedule Conflict',
            'body' => 'The selected teacher has another class at this time.',
        ],
        'group_conflict' => [
            'title' => 'Schedule Conflict',
            'body' => 'This class has another session at the same time.',
        ],
        'success' => [
            'title' => 'Success!',
            'body' => 'Class added to the schedule successfully.',
        ],
    ],
];
