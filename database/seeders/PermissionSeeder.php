<?php

namespace Database\Seeders;

use App\Models\Module;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['guard_name' => 'sanctum', 'name' => 'Admin'],
            ['guard_name' => 'sanctum', 'name' => 'Official User'],
            ['guard_name' => 'sanctum', 'name' => 'LE']
        ];

        $modules = [
            'Members' => [
                ['name' => 'memebers_access', 'guard_name' => 'sanctum'],
                ['name' => 'memebers_create', 'guard_name' => 'sanctum'],
                ['name' => 'memebers_show', 'guard_name' => 'sanctum'],
                ['name' => 'memebers_edit', 'guard_name' => 'sanctum'],
                ['name' => 'memebers_delete', 'guard_name' => 'sanctum'],
            ],
            'Designations' => [
                ['name' => 'designations_access', 'guard_name' => 'sanctum'],
                ['name' => 'designations_create', 'guard_name' => 'sanctum'],
                ['name' => 'designations_show', 'guard_name' => 'sanctum'],
                ['name' => 'designations_edit', 'guard_name' => 'sanctum'],
                ['name' => 'designations_delete', 'guard_name' => 'sanctum'],
            ],

            'Roles' => [
                ['name' => 'roles_access', 'guard_name' => 'sanctum'],
                ['name' => 'roles_create', 'guard_name' => 'sanctum'],
                ['name' => 'roles_show', 'guard_name' => 'sanctum'],
                ['name' => 'roles_edit', 'guard_name' => 'sanctum'],
                ['name' => 'roles_delete', 'guard_name' => 'sanctum'],
            ],

        ];

        foreach ($modules as $key => $permissions) {
            $module = Module::create(['name' => $key]);
            foreach ($permissions as $permission)
                Permission::create(['name' => $permission['name'], 'guard_name' => $permission['guard_name'], 'module_id' => $module->id]);
        }

        $permissions = [];

        Role::insert($roles);
    }
}
