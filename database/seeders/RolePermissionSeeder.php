<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manageUsers = Permission::firstOrCreate(['name' => 'manage users']);
        $manageClientsAnnonces = Permission::firstOrCreate(['name' => 'manage client\'s annonces']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);

        $admin->givePermissionTo([$manageUsers, $manageClientsAnnonces]);
        $manager->givePermissionTo($manageClientsAnnonces);

    }
}
