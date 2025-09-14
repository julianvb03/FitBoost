<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            'password' => Hash::make('julianjuego'),
        ]);

        $adminuser->assignRole($adminRole);
    }
}
