<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberAbsence extends Model
{
    protected $fillable = [
        'member_type',
        'member_id',
        'date',
        'reason',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(AcademicMember::class, 'member_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'member_id');
    }

    public function getMemberFullNameAttribute(): ?string
    {
        if ($this->member_type === 'academic') {
            return optional($this->academicMember)->full_name
                ?? optional($this->academicMember)->last_name . ' ' . optional($this->academicMember)->first_name;
        }

        if ($this->member_type === 'employee') {
            return optional($this->employee)->full_name
                ?? optional($this->employee)->last_name . ' ' . optional($this->employee)->first_name;
        }

        return null;
    }
}
