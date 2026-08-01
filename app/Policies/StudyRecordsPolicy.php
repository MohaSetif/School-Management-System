<?php

namespace App\Policies;

use App\Models\StudyRecord;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class StudyRecordsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, StudyRecord $studyRecord): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isTeacher();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, StudyRecord $studyRecord): bool
    {
        return $user->isTeacher() && $studyRecord->teacher_id == $user->id || $user->isHeadmaster();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, StudyRecord $studyRecord): bool
    {
        return $user->isTeacher() && $studyRecord->teacher_id == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, StudyRecord $studyRecord): bool
    {
        return $user->isTeacher() && $studyRecord->teacher_id == $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, StudyRecord $studyRecord): bool
    {
        return $user->isTeacher() && $studyRecord->teacher_id == $user->id;
    }
}
