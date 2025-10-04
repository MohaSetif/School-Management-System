<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

     public function absences(): HasMany
    {
        return $this->hasMany(MemberAbsence::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->last_name} {$this->first_name}";
    }
}
