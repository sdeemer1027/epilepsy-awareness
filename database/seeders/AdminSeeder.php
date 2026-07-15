<?php

namespace Database\Seeders;

use App\Models\MemberProfile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Seed the platform administrator.
     */
    public function run(): void
    {
        $adminRole = Role::where('slug', 'admin')->first();

        if (! $adminRole) {
            throw new \Exception('Administrator role not found. Run RoleSeeder first.');
        }

        $user = User::updateOrCreate(
            [
                'email' => env('ADMIN_EMAIL', 'admin@esp.local'),
            ],
            [
                'name' => env('ADMIN_NAME', 'ESP Administrator'),
                'password' => Hash::make(
                    env('ADMIN_PASSWORD', 'ChangeMe123!')
                ),
                'role_id' => $adminRole->id,
            ]
        );

        MemberProfile::updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'first_name' => 'ESP',
                'last_name'  => 'Administrator',
                'preferred_name' => 'Administrator',
            ]
        );
    }
}