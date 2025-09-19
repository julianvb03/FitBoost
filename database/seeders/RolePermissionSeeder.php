<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Example of creating a permission and assigning it to a role
        // $manageUsersPermission = Permission::create(['name' => 'manage users']);
        // $adminRole->givePermissionTo($manageUsersPermission);

        // For Testing create a user with admin role

        $adminuser = $user = User::create([
            'name' => 'Admin User',
            'email' => 'valenciajuliann@hotmail.com',
            'password' => Hash::make('contraseña'),
        ]);

        $adminuser->assignRole($adminRole);

        for ($i = 1; $i <= 5; $i++) {
            $user = User::find($i);
            if ($user) {
                $user->assignRole($userRole);
            }
        }
    }
}
