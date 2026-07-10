<?php

declare(strict_types=1);

/**
 * Epilepsy Support Platform (ESP)
 *
 * File: MemberProfilePolicy.php
 * Purpose: Defines authorization rules for member profile management.
 *
 * @package ESP
 * @since 1.0.0-alpha
 * @version 1.0
 */

namespace App\Policies;

use App\Models\MemberProfile;
use App\Models\User;

class MemberProfilePolicy
{
    /**
     * Determine whether the user can view any member profiles.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the member profile.
     */
    public function view(User $user, MemberProfile $memberProfile): bool
    {
        return $this->ownsMemberProfile($user, $memberProfile);
    }

    /**
     * Determine whether the user can create a member profile.
     */
    public function create(User $user): bool
    {
        return $user->memberProfile === null;
    }

    /**
     * Determine whether the user can update the member profile.
     */
    public function update(User $user, MemberProfile $memberProfile): bool
    {
        return $this->ownsMemberProfile($user, $memberProfile);
    }

    /**
     * Determine whether the user can delete the member profile.
     *
     * Disabled for Version 1.
     */
    public function delete(User $user, MemberProfile $memberProfile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the member profile.
     */
    public function restore(User $user, MemberProfile $memberProfile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the member profile.
     */
    public function forceDelete(User $user, MemberProfile $memberProfile): bool
    {
        return false;
    }

    /**
     * Determine whether the member profile belongs to the authenticated user.
     */
    private function ownsMemberProfile(User $user, MemberProfile $memberProfile): bool
    {
        return $user->id === $memberProfile->user_id;
    }
}

