<?php

declare(strict_types=1);

/**
 * Epilepsy Support Platform (ESP)
 *
 * File: Profile.php
 * Purpose: Stores extended profile information for each registered user.
 *
 * @package ESP
 * @since 1.0.0-alpha
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $preferred_name
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $date_of_birth
 * @property-read User $user
 */
class Profile extends BaseModel
{
    protected $table = 'profiles';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'preferred_name',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'city',
        'state_province',
        'postal_code',
        'country',
        'timezone',
        'language',
        'avatar',
        'biography',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
