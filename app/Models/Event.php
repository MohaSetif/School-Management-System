<?php

namespace App\Models;

use Carbon\Carbon;
use Guava\Calendar\Contracts\Eventable;
use Guava\Calendar\ValueObjects\CalendarEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model implements Eventable
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'all_day',
        'color',
        'user_id',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'all_day' => 'boolean',
    ];

    protected $dates = [
        'start_date',
        'end_date',
        'deleted_at',
    ];

    /**
     * Get the user that owns the event
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Convert the model to a CalendarEvent for the calendar widget
     */
    public function toCalendarEvent(): CalendarEvent
    {
        return CalendarEvent::make($this)
            ->title($this->title)
            ->start($this->start_date)
            ->end($this->end_date)
            ->backgroundColor($this->color ?? '#3b82f6')
            ->textColor($this->getTextColor())
            ->allDay($this->all_day ?? false)
            ->action('edit');
    }

    /**
     * Get contrasting text color based on background color
     */
    private function getTextColor(): string
    {
        $color = $this->color ?? '#3b82f6';
        
        // Remove # if present
        $color = ltrim($color, '#');
        
        // Convert hex to RGB
        $r = hexdec(substr($color, 0, 2));
        $g = hexdec(substr($color, 2, 2));
        $b = hexdec(substr($color, 4, 2));
        
        // Calculate relative luminance
        $luminance = (0.299 * $r + 0.587 * $g + 0.114 * $b) / 255;
        
        // Return white for dark colors, black for light colors
        return $luminance > 0.5 ? '#000000' : '#ffffff';
    }

    /**
     * Scope for events within a date range
     */
    public function scopeInDateRange($query, $startDate, $endDate)
    {
        return $query->where(function ($q) use ($startDate, $endDate) {
            $q->whereBetween('start_date', [$startDate, $endDate])
              ->orWhereBetween('end_date', [$startDate, $endDate])
              ->orWhere(function ($q) use ($startDate, $endDate) {
                  $q->where('start_date', '<=', $startDate)
                    ->where('end_date', '>=', $endDate);
              });
        });
    }

    /**
     * Scope for all-day events
     */
    public function scopeAllDay($query)
    {
        return $query->where('all_day', true);
    }

    /**
     * Scope for timed events (not all-day)
     */
    public function scopeTimed($query)
    {
        return $query->where('all_day', false);
    }

    /**
     * Scope for upcoming events
     */
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now());
    }

    /**
     * Scope for past events
     */
    public function scopePast($query)
    {
        return $query->where('end_date', '<', now());
    }

    /**
     * Scope for current events (happening now)
     */
    public function scopeCurrent($query)
    {
        $now = now();
        return $query->where('start_date', '<=', $now)
                    ->where('end_date', '>=', $now);
    }

    /**
     * Get the duration of the event in human-readable format
     */
    public function getDurationAttribute(): string
    {
        if ($this->all_day) {
            $days = $this->start_date->diffInDays($this->end_date) + 1;
            return $days == 1 ? 'All day' : $days . ' days';
        }
        
        return $this->start_date->diffForHumans($this->end_date, true);
    }

    /**
     * Check if the event is currently happening
     */
    public function getIsCurrentAttribute(): bool
    {
        $now = now();
        return $this->start_date <= $now && $this->end_date >= $now;
    }

    /**
     * Check if the event is in the past
     */
    public function getIsPastAttribute(): bool
    {
        return $this->end_date < now();
    }

    /**
     * Check if the event is in the future
     */
    public function getIsUpcomingAttribute(): bool
    {
        return $this->start_date > now();
    }

    /**
     * Boot method to set default values
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($event) {
            if (auth()->check() && !$event->user_id) {
                $event->user_id = auth()->id();
            }
            
            // Set default color if not provided
            if (!$event->color) {
                $event->color = '#3b82f6';
            }
            
            // Ensure end_date is not before start_date
            if ($event->end_date < $event->start_date) {
                $event->end_date = $event->start_date;
            }
        });

        static::updating(function ($event) {
            // Ensure end_date is not before start_date
            if ($event->end_date < $event->start_date) {
                $event->end_date = $event->start_date;
            }
        });
    }
}