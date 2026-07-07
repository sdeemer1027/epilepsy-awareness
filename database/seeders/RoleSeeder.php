<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Role::insert([
            [
                'id' => 1,
                'name' => 'Administrator',
                'slug' => 'admin',
                'description' => 'Full system access',
            ],
            [
                'id' => 2,
                'name' => 'Member',
                'slug' => 'member',
                'description' => 'Registered user',
            ],
            [
                'id' => 3,
                'name' => 'Caregiver',
                'slug' => 'caregiver',
                'description' => 'Caregiver access',
            ],
            [
                'id' => 4,
                'name' => 'Healthcare Professional',
                'slug' => 'healthcare',
                'description' => 'Healthcare resources',
            ],
            [
                'id' => 5,
                'name' => 'Editor',
                'slug' => 'editor',
                'description' => 'Content management',
            ],
        ]);

    }
}
