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
        $adminRole = Role::where('name', 'Admin')->first();
        $managerRole = Role::where('name', 'Manager')->first();
        $chefRole = Role::where('name', 'Chef')->first();
        $waiterRole = Role::where('name', 'Waiter')->first();
        $cashierRole = Role::where('name', 'Cashier')->first();

        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'),
            'role_id' => $adminRole->id,
        ]);

        // Manager user
        User::create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => bcrypt('managerpassword'),
            'role_id' => $managerRole->id,
        ]);

        // Chef user
        User::create([
            'name' => 'Chef User',
            'email' => 'chef@example.com',
            'password' => bcrypt('chefpassword'),
            'role_id' => $chefRole->id,
        ]);

        // Waiter user
        User::create([
            'name' => 'Waiter User',
            'email' => 'waiter@example.com',
            'password' => bcrypt('waiterpassword'),
            'role_id' => $waiterRole->id,
        ]);

        // Cashier user
        User::create([
            'name' => 'Cashier User',
            'email' => 'cashier@example.com',
            'password' => bcrypt('cashierpassword'),
            'role_id' => $cashierRole->id,
        ]);
    }
}
