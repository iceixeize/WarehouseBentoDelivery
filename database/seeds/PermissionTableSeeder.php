<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'Super Admin']);
        $viewRolesPermission = Permission::create(['name' => 'view roles']);
        $editRolesPermission = Permission::create(['name' => 'edit roles']);
        $deleteRolesPermission = Permission::create(['name' => 'delete roles']);

        $role->syncPermissions([
            $viewRolesPermission,
            $editRolesPermission,
            $deleteRolesPermission,
        ]);
    }
}
