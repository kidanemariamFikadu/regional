<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(['name'=>'Admin','guard_name'=>'web']);
        Role::updateOrCreate(['name'=>'Call center agent','guard_name'=>'web']);
        Role::updateOrCreate(['name'=>'Call center evaluator','guard_name'=>'web']);
        Role::updateOrCreate(['name'=>'Call center admin','guard_name'=>'web']);

        $role = Role::where('name','Admin')->first();
        $role->syncPermissions(\Spatie\Permission\Models\Permission::all());
    }
}
