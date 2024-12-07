<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,          // Seed roles
            UserSeeder::class,          // Seed users
            StaffMemberSeeder::class,   // Seed staff members
            MenuItemSeeder::class,      // Seed menu items
            ConcessionSeeder::class,    // Seed concessions
            CategorySeeder::class,      // Seed categories
            OrderSeeder::class,         // Seed orders
        ]);
    }
}
