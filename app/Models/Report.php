<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'school_name',
        'directorate',
        'institution',
        'municipality',
        'location',
        'date',
        'from',
        'to',
        'ref_number',
        'subject',
        'content',
        'file_path',
    ];
}
