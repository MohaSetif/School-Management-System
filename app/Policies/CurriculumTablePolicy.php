<?php

namespace App\Policies;

use App\Models\CurriculumTable;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CurriculumTablePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, CurriculumTable $curriculumTable): bool
    {
        return true;
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
    public function update(User $user, CurriculumTable $curriculumTable): bool
    {
        return $user->isTeacher() || $user->isHeadmaster();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CurriculumTable $curriculumTable): bool
    {
        return $user->isTeacher() || $user->isHeadmaster();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CurriculumTable $curriculumTable): bool
    {
        return $user->isTeacher() || $user->isHeadmaster();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CurriculumTable $curriculumTable): bool
    {
        return $user->isTeacher() || $user->isHeadmaster();
    }
}
