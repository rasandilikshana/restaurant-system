<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\StaffMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => 'password123'],
            ['name' => 'Manager User', 'email' => 'manager@example.com', 'password' => 'password123'],
            ['name' => 'Chef User', 'email' => 'chef@example.com', 'password' => 'password123'],
            ['name' => 'Waiter User', 'email' => 'waiter@example.com', 'password' => 'password123'],
            ['name' => 'Cashier User', 'email' => 'cashier@example.com', 'password' => 'password123'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ]);
        }
    }
}
