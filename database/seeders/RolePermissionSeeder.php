<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin = Role::where(
            'code',
            'ADMIN'
        )->first();

        if (!$admin) {
            return;
        }

        $permissions = Permission::pluck('id');

        $admin->permissions()->sync(
            $permissions
        );
    }
}
