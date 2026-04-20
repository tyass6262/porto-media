<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        
        $admin = Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'admin']
        );
        
        $user = Role::firstOrCreate(
            ['slug' => 'user'],
            ['name' => 'user']
        );
       
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456!!'),
            'role_id' => $admin->id
        ]);
    }
}