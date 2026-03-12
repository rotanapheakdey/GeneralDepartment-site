<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;
use App\Models\Document;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. Create Roles
        $adminRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
        $editorRole = \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'editor']);

        // 2. Create Your Admin User (Rotana)
        $admin = User::updateOrCreate(
            ['email' => 'pheakdeyrotana1@gmail.com'],
            [
                'name' => 'Rotana Admin',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // 3. Create the Editor User
        $editor = User::updateOrCreate(
            ['email' => 'editor@gdib.gov.kh'],
            [
                'name' => 'GDIB Editor',
                'password' => bcrypt('password123'),
                'email_verified_at' => now(),
            ]
        );
        $editor->assignRole($editorRole);

        // --- DUMMY CONTENT GENERATION ---
        $categories = ['News', 'Press Release', 'Announcement', 'Events'];
        foreach ($categories as $cat) {
            \App\Models\Category::firstOrCreate(['name' => $cat]);
        }
        // 4. Generate 12 News Posts
        // This uses the Factory to create varied content for your news cards
        if (class_exists(Post::class)) {
            Post::factory(12)->create();
            $this->command->info('GDIB System: 12 News Posts created.');
        }

        // 5. Generate 10 Official Documents
        // This populates your Prakas/Sub-decree table
        if (class_exists(Document::class)) {
            Document::factory(10)->create();
            $this->command->info('GDIB System: 10 Official Documents created.');
        }

        $this->command->info('GDIB System: Admin, Editor, and Dummy Content seeded successfully!');
    }
}
