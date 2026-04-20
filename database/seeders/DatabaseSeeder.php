<?php

namespace Database\Seeders;

use App\Models\Role;
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
        // User::factory(10)->create();

        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        $recruiter =        Role::create([
            'name' => 'User',
            'slug' => 'user',
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role_id' => $admin->id,
            'password' => bcrypt('password')
        ]);
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => $recruiter->id,
            'password' => bcrypt('password')
        ]);
    }
}
