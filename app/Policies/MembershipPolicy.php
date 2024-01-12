<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Membership;

class MembershipPolicy
{
    /**
     * Create a new policy instance.
     */
    public function editMembership(User $user, Membership $membership)
    {
        // Allow admin to edit any membership
        if ($user->usertype === 'admin') {
            return true;
        }

        // Allow the user to edit their own membership
        return $user->id === $membership->user_id;
    }
}
