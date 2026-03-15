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
        Role::updateOrCreate(
            ['name' => 'engineer'],
            ['description' => 'Engineer role']
        );

        Role::updateOrCreate(
            ['name' => 'manager'],
            ['description' => 'Manager role']
        );

        Role::updateOrCreate(
            ['name' => 'supervisor'],
            ['description' => 'Supervisor role']
        );
    }
}