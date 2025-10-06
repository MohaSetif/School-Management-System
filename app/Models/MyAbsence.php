<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MyAbsence extends Model
{
    protected $table = 'my_absences';

    protected $fillable = [
        'user_id',
        'type',         // notice / without_notice
        'date',         // date of absence
        'start_time',
        'end_time',
        'reason',
        'file_path',    // uploaded file path (nullable)
    ];

    /**
     * Get the employee who declared the absence.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Accessor for readable type label.
     */
    public function getTypeLabelAttribute(): string
    {
        return $this->type === 'notice' ? 'رخصة غياب' : 'إشعار غياب';
    }

    public function getDurationHoursAttribute(): float
    {
        // Optional: calculate number of hours between start and end
        $start = strtotime($this->start_time);
        $end = strtotime($this->end_time);
        return ($end - $start) / 3600;
    }
}
