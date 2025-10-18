<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSettings extends Model
{
    protected $table = 'school_settings';

    protected $fillable = [
        'school_name',
        'school_type',
        'school_type2',
        'director_id',
        'province',
        'district',
        'municipality',
        'location',
        'identification_number',
        'date_established',
        'date_established_number',
        'working_days'
    ];

    public function director(){
        return $this->belongsTo(User::class, 'director_id');
    }
}
