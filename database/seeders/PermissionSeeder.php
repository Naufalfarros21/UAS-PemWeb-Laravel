<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create or update the Admin role
        $role_admin = Role::updateOrCreate(
            [
                'name' => 'Admin',
            ],
            ['name' => 'Admin'],
        );

        // Create or update the permission for Admin menu
        $permission_admin = Permission::updateOrCreate(
            [
                'name' => 'menu_admin',
            ],
            ['name' => 'menu_admin'],
        );

        // Assign the permission to the Admin role
        $role_admin->givePermissionTo($permission_admin);

        // Find the user with ID 1 and assign the Admin role
        $admin_user = User::find(1);

        if ($admin_user) {
            $admin_user->assignRole('Admin');
        }
    }
}