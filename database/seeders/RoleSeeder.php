<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder; 
use Spatie\Permission\Models\Role; 

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo([
            'create-risk',
            'edit-risk',
            'delete-risk',
            'create-mitigation',
            'edit-mitigation',
            'delete-mitigation',
            'read-user'
        ]);
        $user = Role::create(['name' => 'User']);
        $user->givePermissionTo([
            'read-risk',
            'read-mitigation',
        ]);
    }
}
