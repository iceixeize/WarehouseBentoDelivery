<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateUserSuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(User::class)->create([
                'username' => 'iceixeize', 
                'firstname' => 'Ratikarn',
                'lastname' => 'Kaewwiwat',
        ]);

        $user->assignRole('Super Admin');

    }
}
