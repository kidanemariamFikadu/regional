<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            ['name' => 'Evaluate'],
            ['name' => 'Upload audio'],
            ['name' => 'See report'],
            ['name' => 'Export Report'],
            ['name' => 'Add user'],
            ['name' => 'Edit user'],
            ['name' => 'Add job description'],
            ['name' => 'Add regional office'],
            ['name' => 'Manage Role'],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate($permission, $permission);
        }
    }
}
