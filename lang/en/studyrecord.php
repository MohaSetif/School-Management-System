<?php

return [
    'mainTitle' => 'Class Record',
    'navigation' => [
        'label' => 'Class Record',
        'group' => 'Academy Management',
    ],

    'fields' => [
        'teacher_id' => 'Teacher',
        'time' => 'Time',
        'activity' => 'Activity',
        'field' => 'Field',
        'subject' => 'Subject',
        'subject_id' => 'Subject',
        'grade_level' => 'Class',
        'goal' => 'Goal',
        'status' => 'Status',
        'statuses' => [
            'pending' => 'Pending',
            'seen' => 'Reviewed',
        ],
        'remarks' => 'Remarks',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
    ],

    'actions' => [
        'view' => 'View',
        'edit' => 'Edit',
        'delete' => 'Delete',
        'download' => 'Download File',
        'view_report' => 'View Report',
    ],

    'placeholders' => [
        'no_goal' => 'No specific goal',
        'no_remarks' => 'No remarks',
    ],
];
