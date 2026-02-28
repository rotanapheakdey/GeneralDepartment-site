<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create the Roles first (This makes them available as variables)
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $editorRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'editor']);

        // 2. Create Your Admin User
        $admin = \App\Models\User::updateOrCreate(
            ['email' => 'pheakdeyrotana1@gmail.com'],
            [
                'name' => 'Rotana Admin',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // 3. Create the Editor User
        $editor = \App\Models\User::updateOrCreate(
            ['email' => 'editor@gdib.gov.kh'],
            [
                'name' => 'GDIB Editor',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );
        // Now $editorRole is defined and ready to be assigned!
        $editor->assignRole($editorRole);

        $this->command->info('GDIB System: Admin and Editor roles seeded successfully!');
    }
}
