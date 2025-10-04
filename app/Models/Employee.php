<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'place_of_birth',
        'role',
        'image'
    ];
}
