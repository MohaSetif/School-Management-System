<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberAbsence extends Model
{
    protected $fillable = [
        'member_id',
        'date',
        'reason',
        'status',
    ];

    public function member()
    {
        return $this->belongsTo(AcademicMember::class, 'member_id');
    }
}
