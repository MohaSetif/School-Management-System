<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    protected $fillable = [
        'name',
        'email',
        'serial_number',
        'establishment_date',
        'renew_date',
        'score'
    ];
}
