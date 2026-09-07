<?php

namespace App\Policies;

use App\Models\staff;
use Illuminate\Auth\Access\Response;

class StaffPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(staff $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(staff $user, staff $staff): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(staff $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(staff $user, staff $staff): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(staff $user, staff $staff): bool
    {
        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(staff $user, staff $staff): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(staff $user, staff $staff): bool
    {
        return true;
    }
}
