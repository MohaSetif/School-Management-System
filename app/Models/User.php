<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser//, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

     public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_teachers');
    }

    public function attendanceRecords()
    {
        return $this->hasMany(Attendance_record::class, 'marked_by');
    }

    public function isHeadmaster()
    {
        return $this->role === 'headmaster';
    }

    public function isTeacher()
    {
        return $this->role === 'teacher';
    }

    public function schoolSettings()
    {
        return $this->hasOne(SchoolSettings::class, 'director_id');
    }

    public function isEmployee()
    {
        return $this->role === 'employee';
    }

    public function curriculumTables()
    {
        return $this->hasMany(CurriculumTable::class);
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

     public function subjects(): BelongsToMany{
        return $this->belongsToMany(Subject::class, 'subject_teacher'); 
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
