<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicMember extends Model
{
    protected $table = 'academic_members';
    protected $fillable = [
        'postal_account_number',
        'last_name',
        'first_name',
        'rank',
        'appointment_reference_number',
        'appointment_reference_date',
        'appointment_date',
        'confirmation_reference_number',
        'confirmation_reference_date',
        'promotion_reference_number',
        'promotion_reference_date',
        'promotion_start_date',
        'subject',
        'grade',
        'effective_date',
        'postal_account',
        'phone',
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
