<?php

namespace App\Policies;

use App\Models\DailyLog;
use App\Models\User;

class DailyLogPolicy
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
    public function view(User $user, DailyLog $dailyLog): bool
    {
        // User can view their own logs
        if ($dailyLog->user_id === $user->id) {
            return true;
        }

        // Supervisor can view subordinates' logs
        return $dailyLog->user->supervisor_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, DailyLog $dailyLog): bool
    {
        // Only owner can update
        if ($dailyLog->user_id !== $user->id) {
            return false;
        }
        
        // Can edit if pending OR if it's Kepala Dinas own auto-approved log
        return $dailyLog->canBeEdited();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, DailyLog $dailyLog): bool
    {
        // Only owner can delete
        if ($dailyLog->user_id !== $user->id) {
            return false;
        }
        
        // Can delete if pending OR if it's Kepala Dinas own auto-approved log
        return $dailyLog->canBeDeleted();
    }

    /**
     * Determine whether the user can verify the model.
     */
    public function verify(User $user, DailyLog $dailyLog): bool
    {
        // Log must be pending
        if (!$dailyLog->isPending()) {
            return false;
        }
        
        // Kepala Dinas logs cannot be verified (auto-approved)
        if ($dailyLog->user->isKepalaDinas()) {
            return false;
        }

        // User must be the supervisor of the log owner
        return $dailyLog->user->supervisor_id === $user->id;
    }
}
