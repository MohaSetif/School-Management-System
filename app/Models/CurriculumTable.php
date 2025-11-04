<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurriculumTable extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'grade_level',
        'subjects',
        'start_date',
        'month',
        'end_date',
    ];

    protected $casts = [
        'subjects' => 'array', // Automatically decode JSON
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
