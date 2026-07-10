<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\MemberProfile;

/**
 * Epilepsy Support Platform (ESP)
 *
 * File: User.php
 * Purpose: Represents an authenticated user of the Epilepsy Support Platform.
 *
 * @package ESP
 * @since 1.0.0-alpha
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property-read Role|null $role
 * @property-read MemberProfile|null $memberProfile
 * @version 1.0
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the user's assigned role.
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the member profile associated with the user.
     */
    public function memberProfile(): HasOne
    {
        return $this->hasOne(MemberProfile::class);
    }
}
