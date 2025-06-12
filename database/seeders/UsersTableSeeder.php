<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password123'),
        ]);
        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'password' => bcrypt('password123'),
        ]);
        User::create([
            'name' => 'Mike Johnson',
            'email' => 'mike.johnson@example.com',
            'password' => bcrypt('password123'),
        ]);
        User::create([
            'name' => 'Sarah Williams',
            'email' => 'sarah.williams@example.com',
            'password' => bcrypt('password123'),
        ]);
        User::create([
            'name' => 'Robert Brown',
            'email' => 'robert.brown@example.com',
            'password' => bcrypt('password123'),
        ]);
    }
}