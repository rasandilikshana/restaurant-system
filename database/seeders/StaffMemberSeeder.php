<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\StaffMember;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StaffMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $user1 = User::where('email', 'john.doe@example.com')->first();
        $role1 = Role::where('name', 'Admin')->first();
        StaffMember::create(['user_id' => $user1->id, 'role_id' => $role1->id]);

        $user2 = User::where('email', 'jane.smith@example.com')->first();
        $role2 = Role::where('name', 'Manager')->first();
        StaffMember::create(['user_id' => $user2->id, 'role_id' => $role2->id]);
    }
}
