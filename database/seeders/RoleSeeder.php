<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        
        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin'
        ]);

        $user = Role::create([
            'name' => 'User',
            'slug' => 'user'
        ]);

       
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'role_id' => $admin->id
        ]);
    }
}