<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = ['index', 'create', 'view', 'edit', 'delete'];
        $permissions = [
            'root.access', 'root.user', 'root.permission', 'root.role',

            'setting.profile',
            'setting.access', 'setting.access.role', 'setting.access.permission',
            'setting.company', 'setting.company.list', 'setting.company.branch', 'setting.company.organization', 'setting.company.jobfunction', 'setting.company.joblevel', 'setting.company.structure'
        ];
        foreach ($permissions as $permission) {
            foreach ($actions as $action) {
                $data = ['name' => $permission . '-' . $action];
                Permission::firstOrCreate($data);
            }
        }

        $roles = ['Super User', 'Human Resource', 'Employee'];
        foreach ($roles as $role) {
            $data = ['name' => $role];
            Role::firstOrCreate($data);
        }
    }
}