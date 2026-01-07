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
        // Create admin user
        User::create([
            'name' => 'Admin CloudTrip',
            'email' => 'cloudtrip@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Create staff user
        User::create([
            'name' => 'Staff CloudTrip',
            'email' => 'staff@cloudtrip.com',
            'password' => bcrypt('staff123'),
            'role' => 'staff',
        ]);

        // Uncomment untuk membuat dummy users
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
