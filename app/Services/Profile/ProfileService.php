<?php

declare(strict_types=1);

/**
 * Epilepsy Support Platform (ESP)
 *
 * File: ProfileService.php
 * Purpose: Encapsulates all business logic related to user profiles.
 *
 * @package ESP
 * @since 1.0.0-alpha
 * @version 1.0
 */

namespace App\Services\Profile;

use App\Models\Profile;
use App\Models\User;

class ProfileService
{
    /**
     * Create a new profile for the given user.
     *
     * @param User $user
     * @param array<string, mixed> $data
     */
    public function create(User $user, array $data): Profile
    {
        $data['user_id'] = $user->id;

        return Profile::create($data);
    }

    /**
     * Update an existing profile.
     *
     * @param Profile $profile
     * @param array<string, mixed> $data
     */
    public function update(Profile $profile, array $data): Profile
    {
        $profile->update($data);

        return $profile->fresh();
    }
}