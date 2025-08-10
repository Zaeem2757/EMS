<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Admin']);
        $manager = Role::create(['name' => 'Manager']);
        $employee = Role::create(['name' => 'Employee']);

        Permission::create(['name' => 'edit departments']);
        Permission::create(['name' => 'view departments']);
        Permission::create(['name' => 'delete departments']);
        Permission::create(['name' => 'edit employee']);
        Permission::create(['name' => 'view employee']);
        Permission::create(['name' => 'delete employee']);
        Permission::create(['name' => 'assign roles']);

        $admin->givePermissionTo(Permission::all());
        $manager->givePermissionTo(['edit employee','view employee']);
        $employee->givePermissionTo(['view employee']);

    }
}
