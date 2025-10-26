<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumTable extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'grade_level',
        'subject',
        'start_date',
        'end_date',
        'description',
        'table_data',
    ];
}
