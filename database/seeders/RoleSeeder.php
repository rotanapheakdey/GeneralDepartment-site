<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use firstOrCreate to prevent "Already Exists" errors
        $admin = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $editor = Role::firstOrCreate(['name' => 'editor', 'guard_name' => 'web']);

        $manageNews = Permission::firstOrCreate(['name' => 'manage news', 'guard_name' => 'web']);
        $manageUsers = Permission::firstOrCreate(['name' => 'manage users', 'guard_name' => 'web']);

        // Assign
        $admin->givePermissionTo([$manageNews, $manageUsers]);
        $editor->givePermissionTo($manageNews);
    }
}
