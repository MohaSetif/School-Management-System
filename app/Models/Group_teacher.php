<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group_teacher extends Model
{
    protected $fillable = [
        'group_id',
        'user_id',
    ];
}
