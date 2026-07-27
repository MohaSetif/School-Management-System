<?php

return [
    'mainTitle' => 'Administrative Absences',
    'navigation' => [
        'label' => 'Academic Members Absences',
        'group' => 'Absence Management'
    ],
    'form' => [
        'tabs' => [
            'main' => 'Absence',
            'additional' => 'Additional',
        ],
        'sections' => [
            'main' => 'Absence Details',
            'additional' => 'Additional Information',
            'audit' => 'Audit',
            'details' => 'Details',
        ],
        'fields' => [
            'member' => 'Academic Member',
            'absence_date' => 'Absence Date',
            'reason' => 'Reason',
            'notes' => 'Notes',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ],
        'status' => [
            'present' => 'Present',
            'absent' => 'Absent',
            'late' => 'Late',
            'excused' => 'Excused',
            'exit_before_time' => 'Exit Before Time',
        ]
    ],
    'table' => [
        'columns' => [
            'member' => 'Academic Member',
            'absence_date' => 'Absence Date',
            'reason' => 'Reason',
            'created_at' => 'Created At',
        ],
        'filters' => [
            //
        ],
        'actions' => [
            'view' => 'View',
            'edit' => 'Edit',
            'delete' => 'Delete',
        ],
        'bulk_actions' => [
            'delete_selected' => 'Delete Selected',
        ],
    ],
    'messages' => [
        'created_successfully' => 'Absence created successfully.',
        'updated_successfully' => 'Absence updated successfully.',
        'deleted_successfully' => 'Absence deleted successfully.',
        'deleted_selected_successfully' => 'Selected absences deleted successfully.',
    ],
];