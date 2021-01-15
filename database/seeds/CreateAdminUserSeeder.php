<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create([
                'username' => 'System', 
                'firstname' => 'System',
                'lastname' => 'System',
        ]);

        $role = Role::create(['name' => 'Super Admin']);
        $viewRolesPermission = Permission::create(['name' => 'view roles']);
        $editRolesPermission = Permission::create(['name' => 'edit roles']);
        $deleteRolesPermission = Permission::create(['name' => 'delete roles']);

        $role->syncPermissions([
            $viewRolesPermission,
            $editRolesPermission,
            $deleteRolesPermission,
        ]);
   
        $user->assignRole([$role->id]);
    }
}
