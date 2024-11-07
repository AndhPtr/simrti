<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission; 

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-user',
            'edit-user',
            'delete-user',
            'read-user',
            'create-risk',
            'edit-risk',
            'delete-risk',
            'read-risk',
            'create-mitigation',
            'edit-mitigation',
            'delete-mitigation',
            'read-mitigation'
        ];
        // Looping and Inserting Array's Permissions into Permission Table 
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
