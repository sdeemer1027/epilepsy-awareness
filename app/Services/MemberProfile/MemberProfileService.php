<?php

declare(strict_types=1);

/**
 * Epilepsy Support Platform (ESP)
 *
 * File: MemberProfileService.php
 * Purpose: Encapsulates all business logic related to member profiles.
 *
 * @package ESP
 * @since 1.0.0-alpha
 * @version 1.0
 */

namespace App\Services\MemberProfile;

use App\Models\MemberProfile;
use App\Models\User;

class MemberProfileService
{
    /**
     * Create a new profile for the given user.
     *
     * @param User $user
     * @param array<string, mixed> $data
     */
    public function create(User $user, array $data): MemberProfile
    {
        $data['user_id'] = $user->id;

        return MemberProfile::create($data);
    }

    /**
     * Update an existing profile.
     *
     * @param Profile $profile
     * @param array<string, mixed> $data
     */
    public function update(
    MemberProfile $memberProfile,
    array $data
): MemberProfile
    {
        $memberProfile->update($data);

        return $memberProfile->fresh();
    }
}